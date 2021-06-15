<?php
require_once __DIR__.'/_init.php';

$technicalTransactionId = $argv[1];

$apiInstance = new \Teambank\RatenkaufByEasyCreditApiV3\Service\TransactionApi(
    new GuzzleHttp\Client(['debug'=>true]),
    $config
);

try {
    $result = $apiInstance->apiPaymentV3TransactionTechnicalTransactionIdSummaryGet($technicalTransactionId);
    print_r($result);
} catch (Exception $e) {
    print_r($e->getResponseObject());
    echo get_class($e).' when calling TransactionApi->apiPaymentV3TransactionTbTransactionIdSummaryGet: ', $e->getMessage(), PHP_EOL;
}