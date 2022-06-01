<?php
namespace Teambank\RatenkaufByEasyCreditApiV3\Integration;

use Teambank\RatenkaufByEasyCreditApiV3\Service\TransactionApi;
use Teambank\RatenkaufByEasyCreditApiV3\ApiException;
use Teambank\RatenkaufByEasyCreditApiV3\Model\CaptureRequest;
use Teambank\RatenkaufByEasyCreditApiV3\Model\RefundRequest;
use Psr\Log\LoggerInterface;

class Merchant implements MerchantInterface {

    public function __construct(
        TransactionApi $transactionApi,
        LoggerInterface $logger
    ) {
        $this->transactionApi = $transactionApi;
        $this->logger = $logger;
    }

    public function getTransaction($transactionId) {
        return $this->transactionApi->apiMerchantV3TransactionTransactionIdGet($transactionId);
    }

    /**
     * @param mixed[] $params
     */
    public function searchTransactions($params = []) {
        return call_user_func_array([$this->transactionApi, 'apiMerchantV3TransactionGet'], $params);
    }

    /**
     * @param string $transactionId
     */
    public function confirmShipment($transactionId, $trackingNumber = null) {
        $captureRequest = new CaptureRequest(['trackingNumber' => $trackingNumber]);
        return call_user_func_array([$this->transactionApi, 'apiMerchantV3TransactionTransactionIdCapturePost'],[$transactionId, $captureRequest]);
    }

    /**
     * @param string $transactionId
     * @param float|null $amount
     */
    public function cancelOrder($transactionId, $amount = null) {
        $refundRequest = null;
        if ($amount !== null) {
            $refundRequest = new RefundRequest(['value' => $amount]);
        }
        return call_user_func_array([$this->transactionApi, 'apiMerchantV3TransactionTransactionIdRefundPost'],[$transactionId, $refundRequest]);
    }
}
