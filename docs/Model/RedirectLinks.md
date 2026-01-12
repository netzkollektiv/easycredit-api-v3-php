# # RedirectLinks

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**urlSuccess** | **string** | urlErfolg -&gt; Return url address if the transaction is successful | [optional]
**urlCancellation** | **string** | urlAbbruch -&gt; Return url address if the transaction is canceled | [optional]
**urlDenial** | **string** | urlAblehnung -&gt; Return url address if the transaction is denied | [optional]
**urlAuthorizationCallback** | **string** | &#39; Optional Callback-Url for authorization endpoint. If provided the callback will be performed, else not. &#39; | [optional]
**urlStatusChangeNotifyCallback** | **string** | &#39; Optional Status-Change-Notify-Url for transaction status changes. If the transaction changes status the provided callback will be called with a GET request. If you provide a callback-url like https://www.example.com you will be notified about the transaction through GET https://www.example.com?transactionId&#x3D;&lt;technicalTransactionId&gt; &#39; | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
