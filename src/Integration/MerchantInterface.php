<?php
namespace Teambank\RatenkaufByEasyCreditApiV3\Integration;

interface MerchantInterface {
    public function getTransaction($transactionId);
    /**
     * @param mixed[] $params
     */
    public function searchTransactions($params = []);
    /**
     * @param string $transactionId
     */
    public function confirmShipment($transactionId, $trackingNumber = null);
    /**
     * @param string $transactionId
     * @param float|null $amount
     */
    public function cancelOrder($transactionId, $amount = null);
}
