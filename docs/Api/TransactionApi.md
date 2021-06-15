# Teambank\RatenkaufByEasyCreditApiV3\TransactionApi

All URIs are relative to http://localhost.

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiPaymentV3TransactionPost()**](TransactionApi.md#apiPaymentV3TransactionPost) | **POST** /api/payment/v3/transaction | Initiates a transaction based on the given request
[**apiPaymentV3TransactionTechnicalTransactionIdAuthorizationGet()**](TransactionApi.md#apiPaymentV3TransactionTechnicalTransactionIdAuthorizationGet) | **GET** /api/payment/v3/transaction/{technicalTransactionId}/authorization | Returns the authorization status of a transaction
[**apiPaymentV3TransactionTechnicalTransactionIdPatch()**](TransactionApi.md#apiPaymentV3TransactionTechnicalTransactionIdPatch) | **PATCH** /api/payment/v3/transaction/{technicalTransactionId} | Updates a transaction based on the given request
[**apiPaymentV3TransactionTechnicalTransactionIdPreAuthorizationPost()**](TransactionApi.md#apiPaymentV3TransactionTechnicalTransactionIdPreAuthorizationPost) | **POST** /api/payment/v3/transaction/{technicalTransactionId}/preAuthorization | Preauthorizes a transaction after finishing the process in a webshop
[**apiPaymentV3TransactionTechnicalTransactionIdSummaryGet()**](TransactionApi.md#apiPaymentV3TransactionTechnicalTransactionIdSummaryGet) | **GET** /api/payment/v3/transaction/{technicalTransactionId}/summary | Get the necessary information regarding the transaction for checkout


## `apiPaymentV3TransactionPost()`

```php
apiPaymentV3TransactionPost($transactionInitRequest): \Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionInitResponse
```

Initiates a transaction based on the given request

' A transaction is created with unique identifiers (a TeamBank identifier <technicalTransactionId> and a functional identifier <transactionId>). The data in the request is validated and normalised and, if necessary, corresponding error messages are returned. Supports body signature. '

### Example

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

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **transactionInitRequest** | [**\Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionInitRequest**](../Model/TransactionInitRequest.md)| init request | [optional]

### Return type

[**\Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionInitResponse**](../Model/TransactionInitResponse.md)

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/hal+json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiPaymentV3TransactionTechnicalTransactionIdAuthorizationGet()`

```php
apiPaymentV3TransactionTechnicalTransactionIdAuthorizationGet($technicalTransactionId): \Teambank\RatenkaufByEasyCreditApiV3\Model\AuthorizationStatusResponse
```

Returns the authorization status of a transaction

' The authorization status of a transaction will be returned. '

### Example

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
$technicalTransactionId = 'technicalTransactionId_example'; // string | Unique TeamBank transaction identifier

try {
    $result = $apiInstance->apiPaymentV3TransactionTechnicalTransactionIdAuthorizationGet($technicalTransactionId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TransactionApi->apiPaymentV3TransactionTechnicalTransactionIdAuthorizationGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **technicalTransactionId** | **string**| Unique TeamBank transaction identifier |

### Return type

[**\Teambank\RatenkaufByEasyCreditApiV3\Model\AuthorizationStatusResponse**](../Model/AuthorizationStatusResponse.md)

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/hal+json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiPaymentV3TransactionTechnicalTransactionIdPatch()`

```php
apiPaymentV3TransactionTechnicalTransactionIdPatch($technicalTransactionId, $transactionUpdateRequest): \Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionSummaryResponse
```

Updates a transaction based on the given request

Based on the unique TeamBank identifier, transaction's specific data is modified. Supports body signature.

### Example

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
$technicalTransactionId = 'technicalTransactionId_example'; // string | Unique TeamBank transaction identifier
$transactionUpdateRequest = new \Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionUpdateRequest(); // \Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionUpdateRequest | update request

try {
    $result = $apiInstance->apiPaymentV3TransactionTechnicalTransactionIdPatch($technicalTransactionId, $transactionUpdateRequest);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TransactionApi->apiPaymentV3TransactionTechnicalTransactionIdPatch: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **technicalTransactionId** | **string**| Unique TeamBank transaction identifier |
 **transactionUpdateRequest** | [**\Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionUpdateRequest**](../Model/TransactionUpdateRequest.md)| update request | [optional]

### Return type

[**\Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionSummaryResponse**](../Model/TransactionSummaryResponse.md)

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/hal+json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiPaymentV3TransactionTechnicalTransactionIdPreAuthorizationPost()`

```php
apiPaymentV3TransactionTechnicalTransactionIdPreAuthorizationPost($technicalTransactionId)
```

Preauthorizes a transaction after finishing the process in a webshop

' The preauthorization of a transaction will be triggered asynchronous. After processing all necessary checks there will be an optional callback to the url that was provided in initialization and you can get the updated status information. '

### Example

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
$technicalTransactionId = 'technicalTransactionId_example'; // string | Unique TeamBank transaction identifier

try {
    $apiInstance->apiPaymentV3TransactionTechnicalTransactionIdPreAuthorizationPost($technicalTransactionId);
} catch (Exception $e) {
    echo 'Exception when calling TransactionApi->apiPaymentV3TransactionTechnicalTransactionIdPreAuthorizationPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **technicalTransactionId** | **string**| Unique TeamBank transaction identifier |

### Return type

void (empty response body)

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `apiPaymentV3TransactionTechnicalTransactionIdSummaryGet()`

```php
apiPaymentV3TransactionTechnicalTransactionIdSummaryGet($technicalTransactionId): \Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionSummaryResponse
```

Get the necessary information regarding the transaction for checkout

' Based on the unique TeamBank identifier, the necessary information of the corresponding transaction is returned for checkout. Supports body signature. '

### Example

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
$technicalTransactionId = 'technicalTransactionId_example'; // string | Unique TeamBank transaction identifier

try {
    $result = $apiInstance->apiPaymentV3TransactionTechnicalTransactionIdSummaryGet($technicalTransactionId);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TransactionApi->apiPaymentV3TransactionTechnicalTransactionIdSummaryGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **technicalTransactionId** | **string**| Unique TeamBank transaction identifier |

### Return type

[**\Teambank\RatenkaufByEasyCreditApiV3\Model\TransactionSummaryResponse**](../Model/TransactionSummaryResponse.md)

### Authorization

[basicAuth](../../README.md#basicAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/hal+json`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
