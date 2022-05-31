# Teambank\RatenkaufByEasyCreditApiV3\DocumentApi

All URIs are relative to https://partner.easycredit-ratenkauf.de.

Method | HTTP request | Description
------------- | ------------- | -------------
[**apiMerchantV3DocumentsGet()**](DocumentApi.md#apiMerchantV3DocumentsGet) | **GET** /api/merchant/v3/documents | Download billing documents of a merchant.


## `apiMerchantV3DocumentsGet()`

```php
apiMerchantV3DocumentsGet($billingDateFrom, $billingDateTo, $documentType, $webshopId, $fileType): \SplFileObject
```

Download billing documents of a merchant.

' Download billing documents of a merchant. Following parameters can be given to restrict: billing date from/to, document type, webshop id and file type If no date range is given, all billing documents of the last month will be returned. '

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer (JWT) authorization: bearerAuth
$config = Teambank\RatenkaufByEasyCreditApiV3\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new Teambank\RatenkaufByEasyCreditApiV3\Api\DocumentApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$billingDateFrom = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime
$billingDateTo = new \DateTime("2013-10-20T19:20:30+01:00"); // \DateTime
$documentType = array('documentType_example'); // string[]
$webshopId = array('webshopId_example'); // string[]
$fileType = array('fileType_example'); // string[]

try {
    $result = $apiInstance->apiMerchantV3DocumentsGet($billingDateFrom, $billingDateTo, $documentType, $webshopId, $fileType);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentApi->apiMerchantV3DocumentsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **billingDateFrom** | **\DateTime**|  | [optional]
 **billingDateTo** | **\DateTime**|  | [optional]
 **documentType** | [**string[]**](../Model/string.md)|  | [optional]
 **webshopId** | [**string[]**](../Model/string.md)|  | [optional]
 **fileType** | [**string[]**](../Model/string.md)|  | [optional]

### Return type

**\SplFileObject**

### Authorization

[bearerAuth](../../README.md#bearerAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/zip`, `application/problem+json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
