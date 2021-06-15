<?php
require_once __DIR__.'/_init.php';

$apiInstance = new \Teambank\RatenkaufByEasyCreditApiV3\Service\WebshopApi(
    new GuzzleHttp\Client(['debug'=>true]),
    $config
);

$result = $apiInstance->apiPaymentV3WebshopIntegrationcheckPost(new \Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckRequest([
    'message' => 'test'
]));
print_r($result);