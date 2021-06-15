<?php
/**
 * TransactionUpdateRequest
 *
 * PHP version 7.2
 *
 * @category Class
 * @package  Teambank\RatenkaufByEasyCreditApiV3
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Ratenkauf Verkauf-V3 API Definition
 *
 * Ratenkauf Verkauf-V3 API for ratenkauf App
 *
 * The version of the OpenAPI document: V3.68.3
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.2.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Teambank\RatenkaufByEasyCreditApiV3\Model;

use \ArrayAccess;
use \Teambank\RatenkaufByEasyCreditApiV3\ObjectSerializer;

/**
 * TransactionUpdateRequest Class Doc Comment
 *
 * @category Class
 * @package  Teambank\RatenkaufByEasyCreditApiV3
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class TransactionUpdateRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TransactionUpdateRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'orderValue' => 'float',
        'numberOfProductsInShoppingCart' => 'int',
        'shoppingCartInformation' => '\Teambank\RatenkaufByEasyCreditApiV3\Model\ShoppingCartInformationItem[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'orderValue' => null,
        'numberOfProductsInShoppingCart' => null,
        'shoppingCartInformation' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'orderValue' => 'orderValue',
        'numberOfProductsInShoppingCart' => 'numberOfProductsInShoppingCart',
        'shoppingCartInformation' => 'shoppingCartInformation'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'orderValue' => 'setOrderValue',
        'numberOfProductsInShoppingCart' => 'setNumberOfProductsInShoppingCart',
        'shoppingCartInformation' => 'setShoppingCartInformation'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'orderValue' => 'getOrderValue',
        'numberOfProductsInShoppingCart' => 'getNumberOfProductsInShoppingCart',
        'shoppingCartInformation' => 'getShoppingCartInformation'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['orderValue'] = $data['orderValue'] ?? null;
        $this->container['numberOfProductsInShoppingCart'] = $data['numberOfProductsInShoppingCart'] ?? null;
        $this->container['shoppingCartInformation'] = $data['shoppingCartInformation'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['orderValue'] === null) {
            $invalidProperties[] = "'orderValue' can't be null";
        }
        if (($this->container['orderValue'] > 10000)) {
            $invalidProperties[] = "invalid value for 'orderValue', must be smaller than or equal to 10000.";
        }

        if (($this->container['orderValue'] < 199)) {
            $invalidProperties[] = "invalid value for 'orderValue', must be bigger than or equal to 199.";
        }

        if (!is_null($this->container['shoppingCartInformation']) && (count($this->container['shoppingCartInformation']) < 1)) {
            $invalidProperties[] = "invalid value for 'shoppingCartInformation', number of items must be greater than or equal to 1.";
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets orderValue
     *
     * @return float
     */
    public function getOrderValue()
    {
        return $this->container['orderValue'];
    }

    /**
     * Sets orderValue
     *
     * @param float $orderValue Amount in €
     *
     * @return self
     */
    public function setOrderValue($orderValue)
    {

        if (($orderValue > 10000)) {
            throw new \InvalidArgumentException('invalid value for $orderValue when calling TransactionUpdateRequest., must be smaller than or equal to 10000.');
        }
        if (($orderValue < 199)) {
            throw new \InvalidArgumentException('invalid value for $orderValue when calling TransactionUpdateRequest., must be bigger than or equal to 199.');
        }

        $this->container['orderValue'] = $orderValue;

        return $this;
    }

    /**
     * Gets numberOfProductsInShoppingCart
     *
     * @return int|null
     */
    public function getNumberOfProductsInShoppingCart()
    {
        return $this->container['numberOfProductsInShoppingCart'];
    }

    /**
     * Sets numberOfProductsInShoppingCart
     *
     * @param int|null $numberOfProductsInShoppingCart numberOfProductsInShoppingCart
     *
     * @return self
     */
    public function setNumberOfProductsInShoppingCart($numberOfProductsInShoppingCart)
    {
        $this->container['numberOfProductsInShoppingCart'] = $numberOfProductsInShoppingCart;

        return $this;
    }

    /**
     * Gets shoppingCartInformation
     *
     * @return \Teambank\RatenkaufByEasyCreditApiV3\Model\ShoppingCartInformationItem[]|null
     */
    public function getShoppingCartInformation()
    {
        return $this->container['shoppingCartInformation'];
    }

    /**
     * Sets shoppingCartInformation
     *
     * @param \Teambank\RatenkaufByEasyCreditApiV3\Model\ShoppingCartInformationItem[]|null $shoppingCartInformation shoppingCartInformation
     *
     * @return self
     */
    public function setShoppingCartInformation($shoppingCartInformation)
    {


        if (!is_null($shoppingCartInformation) && (count($shoppingCartInformation) < 1)) {
            throw new \InvalidArgumentException('invalid length for $shoppingCartInformation when calling TransactionUpdateRequest., number of items must be greater than or equal to 1.');
        }
        $this->container['shoppingCartInformation'] = $shoppingCartInformation;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


