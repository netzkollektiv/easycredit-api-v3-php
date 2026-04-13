<?php

namespace Teambank\EasyCreditApiV3\Test\Integration;

use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\TestCase;
use Teambank\EasyCreditApiV3\ApiException;
use Teambank\EasyCreditApiV3\Configuration;
use Teambank\EasyCreditApiV3\Integration\AmountOutOfRangeException;
use Teambank\EasyCreditApiV3\Integration\Checkout;
use Teambank\EasyCreditApiV3\Integration\StorageInterface;
use Teambank\EasyCreditApiV3\Integration\Util\AddressValidator;
use Teambank\EasyCreditApiV3\Integration\Util\PrefixConverter;
use Teambank\EasyCreditApiV3\Model\OrderDetails;
use Teambank\EasyCreditApiV3\Model\ShippingAddress;
use Teambank\EasyCreditApiV3\Model\Transaction;
use Teambank\EasyCreditApiV3\Model\TransactionInformation;
use Teambank\EasyCreditApiV3\Model\TransactionInitResponse;
use Teambank\EasyCreditApiV3\Service\InstallmentplanApi;
use Teambank\EasyCreditApiV3\Service\TransactionApi;
use Teambank\EasyCreditApiV3\Service\WebshopApi;

#[AllowMockObjectsWithoutExpectations]
class CheckoutTest extends TestCase
{
    public function testStartStoresExpectedCheckoutState(): void
    {
        $storage = new InMemoryStorage();
        $logger = new TestLogger();

        $request = new Transaction([
            'orderDetails' => new OrderDetails([
                'orderValue' => 200.0,
                'shippingAddress' => new ShippingAddress([
                    'firstName' => 'Ralf',
                    'lastName' => 'Ratenkauf',
                    'address' => 'Beuthener Str. 25',
                    'zip' => '90471',
                    'city' => 'Nuernberg',
                    'country' => 'DE',
                ]),
            ]),
        ]);

        $transactionModel = new Transaction(['orderDetails' => new OrderDetails(['orderValue' => 200.0])]);
        $transactionModel->setPaymentType(Transaction::PAYMENT_TYPE_INSTALLMENT_PAYMENT);

        $transactionInfo = $this->createMock(TransactionInformation::class);
        $transactionInfo->method('getTransaction')->willReturn($transactionModel);

        $initResponse = $this->createMock(TransactionInitResponse::class);
        $initResponse->method('getTechnicalTransactionId')->willReturn('technical-id');
        $initResponse->method('getTransactionId')->willReturn('transaction-id');
        $initResponse->method('getTransactionInformation')->willReturn($transactionInfo);
        $initResponse->method('getRedirectUrl')->willReturn('https://example.test/redirect');

        $transactionApi = $this->createMock(TransactionApi::class);
        $transactionApi->expects($this->once())
            ->method('apiPaymentV3TransactionPost')
            ->with($request)
            ->willReturn($initResponse);

        $checkout = new Checkout(
            $this->createMock(WebshopApi::class),
            $transactionApi,
            $this->createMock(InstallmentplanApi::class),
            $storage,
            new AddressValidator(),
            new PrefixConverter(),
            $logger
        );

        $checkout->start($request);

        $this->assertSame('technical-id', $storage->get('token'));
        $this->assertSame('transaction-id', $storage->get('transaction_id'));
        $this->assertSame('https://example.test/redirect', $storage->get('redirect_url'));
    }

    public function testIsApprovedReturnsFalseAndLogsOnInvalidSummaryJson(): void
    {
        $storage = new InMemoryStorage();
        $storage->set('summary', '{invalid json');
        $logger = new TestLogger();

        $checkout = new Checkout(
            $this->createMock(WebshopApi::class),
            $this->createMock(TransactionApi::class),
            $this->createMock(InstallmentplanApi::class),
            $storage,
            new AddressValidator(),
            new PrefixConverter(),
            $logger
        );

        $this->assertFalse($checkout->isApproved());
        $this->assertNotEmpty($logger->warnings);
    }

    public function testIsAvailableThrowsAmountOutOfRangeExceptionOn400(): void
    {
        $storage = new InMemoryStorage();
        $logger = new TestLogger();

        $request = new Transaction([
            'orderDetails' => new OrderDetails([
                'orderValue' => 500.0,
                'invoiceAddress' => new ShippingAddress([
                    'firstName' => 'Ralf',
                    'lastName' => 'Ratenkauf',
                    'address' => 'Street 1',
                    'zip' => '90471',
                    'city' => 'Nuernberg',
                    'country' => 'DE',
                ]),
                'shippingAddress' => new ShippingAddress([
                    'firstName' => 'Ralf',
                    'lastName' => 'Ratenkauf',
                    'address' => 'Street 1',
                    'zip' => '90471',
                    'city' => 'Nuernberg',
                    'country' => 'DE',
                ]),
            ]),
            'customer' => new \Teambank\EasyCreditApiV3\Model\Customer([
                'firstName' => 'Ralf',
                'lastName' => 'Ratenkauf',
            ]),
            'customerRelationship' => new \Teambank\EasyCreditApiV3\Model\CustomerRelationship([
                'orderDoneWithLogin' => false,
            ]),
        ]);

        $config = new Configuration();
        $config->setUsername('shop-identifier');

        $webshopApi = $this->createMock(WebshopApi::class);
        $webshopApi->method('getConfig')->willReturn($config);

        $installmentplanApi = $this->createMock(InstallmentplanApi::class);
        $installmentplanApi->method('apiRatenrechnerV3WebshopShopIdentifierInstallmentplansPost')
            ->willThrowException(new ApiException('bad request', 400));

        $checkout = new Checkout(
            $webshopApi,
            $this->createMock(TransactionApi::class),
            $installmentplanApi,
            $storage,
            new AddressValidator(),
            new PrefixConverter(),
            $logger
        );

        $this->expectException(AmountOutOfRangeException::class);
        $checkout->isAvailable($request, true);
    }
}

final class InMemoryStorage implements StorageInterface
{
    /** @var array<string, mixed> */
    private $data = [];

    public function set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function get($key)
    {
        return $this->data[$key] ?? null;
    }

    public function clear()
    {
        $this->data = [];
        return $this;
    }
}

final class TestLogger
{
    /** @var array<int, mixed> */
    public $warnings = [];

    public function warning($message, array $context = []): void
    {
        $this->warnings[] = [$message, $context];
    }

    public function debug($message, array $context = []): void
    {
    }
}

