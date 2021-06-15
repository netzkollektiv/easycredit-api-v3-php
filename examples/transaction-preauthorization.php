<?php
require_once __DIR__.'/_init.php';

$technicalTransactionId = $argv[1];

$apiInstance = new \Teambank\RatenkaufByEasyCreditApiV3\Service\TransactionApi(
    new GuzzleHttp\Client(['debug'=>true]),
    $config
);

$result = $apiInstance->apiPaymentV3TransactionTechnicalTransactionIdPreAuthorizationPost($technicalTransactionId);
print_r($result);