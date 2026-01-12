# # OrderDetails

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**orderValue** | **float** | Amount in € |
**orderId** | **string** | Shop transaction identifier (allows the shop to store its own reference for the transaction). This is a required field for direct sales transactions. | [optional]
**numberOfProductsInShoppingCart** | **int** | anzahlProdukteImWarenkorb | [optional]
**withoutFlexprice** | **bool** | Indicator should always be FALSE except a flex price should not be shown, although it is available | [optional] [default to false]
**invoiceAddress** | [**\Teambank\EasyCreditApiV3\Model\InvoiceAddress**](InvoiceAddress.md) |  | [optional]
**shippingAddress** | [**\Teambank\EasyCreditApiV3\Model\ShippingAddress**](ShippingAddress.md) |  | [optional]
**shoppingCartInformation** | [**\Teambank\EasyCreditApiV3\Model\ShoppingCartInformationItem[]**](ShoppingCartInformationItem.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
