<?php
/**
 * TransactionApiTest
 *
 * @category Class
 * @package  Teambank\EasyCreditApiV3
 *
 * Transaction-V3 API Definition
 * @author   NETZKOLLEKTIV GmbH
 * @link     https://netzkollektiv.com

 */

namespace Teambank\EasyCreditApiV3\Test\Api;

use \Teambank\EasyCreditApiV3\Configuration;
use \Teambank\EasyCreditApiV3\ApiException;
use \Teambank\EasyCreditApiV3\ObjectSerializer;
use PHPUnit\Framework\TestCase;

/**
 * TransactionApiTest Class Doc Comment
 *
 * @category Class
 * @package  Teambank\EasyCreditApiV3
 */
class TransactionApiTest extends TestCase
{

    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass(): void
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp(): void
    {
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown(): void
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass(): void
    {
    }

    /**
     * Test case for apiMerchantV3TransactionGet
     *
     * Find transactions of a merchant according to some search parameters..
     *
     */
    public function testApiMerchantV3TransactionGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for apiMerchantV3TransactionTransactionIdCapturePost
     *
     * Report a capture for a transaction according to its unique functional identifier.
     *
     */
    public function testApiMerchantV3TransactionTransactionIdCapturePost()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for apiMerchantV3TransactionTransactionIdGet
     *
     * Retrieve a transaction of a merchant according to a unique functional identifier.
     *
     */
    public function testApiMerchantV3TransactionTransactionIdGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for apiMerchantV3TransactionTransactionIdRefundPost
     *
     * Report a refund for a transaction according to its unique functional identifier.
     *
     */
    public function testApiMerchantV3TransactionTransactionIdRefundPost()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for apiPaymentV3TransactionPost
     *
     * Initiates a transaction based on the given request.
     *
     */
    public function testApiPaymentV3TransactionPost()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for apiPaymentV3TransactionTechnicalTransactionIdAuthorizationPost
     *
     * Authorizes a transaction after finishing the process in a webshop.
     *
     */
    public function testApiPaymentV3TransactionTechnicalTransactionIdAuthorizationPost()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for apiPaymentV3TransactionTechnicalTransactionIdGet
     *
     * Get the necessary information about the transaction.
     *
     */
    public function testApiPaymentV3TransactionTechnicalTransactionIdGet()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for apiPaymentV3TransactionTechnicalTransactionIdPatch
     *
     * Updates a transaction based on the given request.
     *
     */
    public function testApiPaymentV3TransactionTechnicalTransactionIdPatch()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }

    /**
     * Test case for apiPaymentV3TransactionTechnicalTransactionIdSwitchPaymentMethodPost
     *
     * Switch payment method.
     *
     */
    public function testApiPaymentV3TransactionTechnicalTransactionIdSwitchPaymentMethodPost()
    {
        // TODO: implement
        $this->markTestIncomplete('Not implemented');
    }
}
