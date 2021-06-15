# ratenkaufbyeasycredit-payment-api-v3-php

Ratenkauf Verkauf-V3 API for ratenkauf App


## Installation & Usage

### Requirements

PHP 7.2 and later.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/netzkollektiv/ratenkaufbyeasycredit-payment-api-v3-php.git"
    }
  ],
  "require": {
    "netzkollektiv/ratenkaufbyeasycredit-payment-api-v3-php": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/ratenkaufbyeasycredit-payment-api-v3-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure HTTP basic authorization: basicAuth
$config = Teambank\RatenkaufByEasyCreditApiV3\Configuration::getDefaultConfiguration()
              ->setHost('https://ratenkauf.easycredit.de')
              ->setUsername('1.de.1234.1') // use your "Webshop-ID"
              ->setPassword('YOUR_API_KEY'); // use your "API-Kennwort"


$apiInstance = new Teambank\RatenkaufByEasyCreditApiV3\Api\TransactionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$transactionInitRequest = new \Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionInitRequest(); // \Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionInitRequest | init request

try {
    $result = $apiInstance->apiPaymentV3TransactionPost($transactionInitRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TransactionApi->apiPaymentV3TransactionPost: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *http://localhost*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*TransactionApi* | [**apiPaymentV3TransactionPost**](docs/Api/TransactionApi.md#apipaymentv3transactionpost) | **POST** /api/payment/v3/transaction | Initiates a transaction based on the given request
*TransactionApi* | [**apiPaymentV3TransactionTechnicalTransactionIdAuthorizationGet**](docs/Api/TransactionApi.md#apipaymentv3transactiontechnicaltransactionidauthorizationget) | **GET** /api/payment/v3/transaction/{technicalTransactionId}/authorization | Returns the authorization status of a transaction
*TransactionApi* | [**apiPaymentV3TransactionTechnicalTransactionIdPatch**](docs/Api/TransactionApi.md#apipaymentv3transactiontechnicaltransactionidpatch) | **PATCH** /api/payment/v3/transaction/{technicalTransactionId} | Updates a transaction based on the given request
*TransactionApi* | [**apiPaymentV3TransactionTechnicalTransactionIdPreAuthorizationPost**](docs/Api/TransactionApi.md#apipaymentv3transactiontechnicaltransactionidpreauthorizationpost) | **POST** /api/payment/v3/transaction/{technicalTransactionId}/preAuthorization | Preauthorizes a transaction after finishing the process in a webshop
*TransactionApi* | [**apiPaymentV3TransactionTechnicalTransactionIdSummaryGet**](docs/Api/TransactionApi.md#apipaymentv3transactiontechnicaltransactionidsummaryget) | **GET** /api/payment/v3/transaction/{technicalTransactionId}/summary | Get the necessary information regarding the transaction for checkout
*WebshopApi* | [**apiPaymentV3WebshopGet**](docs/Api/WebshopApi.md#apipaymentv3webshopget) | **GET** /api/payment/v3/webshop | Get the necessary information about the webshop
*WebshopApi* | [**apiPaymentV3WebshopIntegrationcheckPost**](docs/Api/WebshopApi.md#apipaymentv3webshopintegrationcheckpost) | **POST** /api/payment/v3/webshop/integrationcheck | Verifies the correctness of the merchant&#39;s authentication credentials and, if enabled, the body signature

## Models

- [Address](docs/Model/Address.md)
- [ArticleNumberItem](docs/Model/ArticleNumberItem.md)
- [AuthenticationError](docs/Model/AuthenticationError.md)
- [AuthorizationStatusResponse](docs/Model/AuthorizationStatusResponse.md)
- [Bank](docs/Model/Bank.md)
- [ConstraintViolation](docs/Model/ConstraintViolation.md)
- [ConstraintViolationViolations](docs/Model/ConstraintViolationViolations.md)
- [Contact](docs/Model/Contact.md)
- [Customer](docs/Model/Customer.md)
- [CustomerRelationship](docs/Model/CustomerRelationship.md)
- [Employment](docs/Model/Employment.md)
- [IntegrationCheckRequest](docs/Model/IntegrationCheckRequest.md)
- [IntegrationCheckResponse](docs/Model/IntegrationCheckResponse.md)
- [OrderDetails](docs/Model/OrderDetails.md)
- [RedirectLinks](docs/Model/RedirectLinks.md)
- [ServerError](docs/Model/ServerError.md)
- [ShippingAddress](docs/Model/ShippingAddress.md)
- [ShippingAddressAllOf](docs/Model/ShippingAddressAllOf.md)
- [ShoppingCartInformationItem](docs/Model/ShoppingCartInformationItem.md)
- [Shopsystem](docs/Model/Shopsystem.md)
- [TransactionInitRequest](docs/Model/TransactionInitRequest.md)
- [TransactionInitResponse](docs/Model/TransactionInitResponse.md)
- [TransactionSummaryResponse](docs/Model/TransactionSummaryResponse.md)
- [TransactionUpdateRequest](docs/Model/TransactionUpdateRequest.md)
- [WebshopResponse](docs/Model/WebshopResponse.md)

## Authorization

### basicAuth

- **Type**: HTTP basic authentication

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `V3.68.3`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
