<?php
require_once(__DIR__  .  '/../vendor/autoload.php');

// Configure HTTP basic authorization: basicAuth
echo getenv('EASYCREDIT_USER').' : '.getenv('EASYCREDIT_PASSWORD');

$config = \Teambank\RatenkaufByEasyCreditApiV3\Configuration::getDefaultConfiguration()
    ->setHost('https://ratenkauf.easycredit.de')
    ->setUsername(getenv('EASYCREDIT_USER'))
    ->setPassword(getenv('EASYCREDIT_PASSWORD'));  


$apiInstance = new \Teambank\RatenkaufByEasyCreditApiV3\Service\TransactionApi(
    new GuzzleHttp\Client(['debug'=>true]),
    $config
);