<?php
/**
 * TransactionApi
 *
 * @category Class
 * @package  Teambank\EasyCreditApiV3
 *
 * Transaction-V3 API Definition
 * @author   NETZKOLLEKTIV GmbH
 * @link     https://netzkollektiv.com
 */

namespace Teambank\EasyCreditApiV3\Service;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\NetworkExceptionInterface;

use Teambank\EasyCreditApiV3\ApiException;
use Teambank\EasyCreditApiV3\Configuration;
use Teambank\EasyCreditApiV3\HeaderSelector;
use Teambank\EasyCreditApiV3\ObjectSerializer;
use Teambank\EasyCreditApiV3\Client;
use GuzzleHttp\Psr7\Request;

/**
 * TransactionApi Class
 *
 * @category Class
 * @package  Teambank\EasyCreditApiV3
 */
class TransactionApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ?ClientInterface $client = null,
        ?Configuration $config = null,
        ?HeaderSelector $selector = null,
        int $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex(int $hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex(): int
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig(): Configuration
    {
        return $this->config;
    }

    /**
     * Operation apiMerchantV3TransactionGet
     *
     * Find transactions of a merchant according to some search parameters.
     *
     * @param  string $firstname firstname (optional)
     * @param  string $lastname lastname (optional)
     * @param  string $orderId orderId (optional)
     * @param  int $pageSize pageSize (optional, default to 100)
     * @param  int $page page (optional)
     * @param  string[] $status status (optional)
     * @param  float $minOrderValue minOrderValue (optional)
     * @param  float $maxOrderValue maxOrderValue (optional)
     * @param  string[] $tId Multiple unique functional transaction identifier (consists of 6 characters) provided through the query (optional)
     * @param  string[] $webshopIds webshopIds (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Teambank\EasyCreditApiV3\Model\TransactionListInfo|\Teambank\EasyCreditApiV3\Model\ConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation
     */
    public function apiMerchantV3TransactionGet($firstname = null, $lastname = null, $orderId = null, $pageSize = 100, $page = null, $status = null, $minOrderValue = null, $maxOrderValue = null, $tId = null, $webshopIds = null)
    {
        list($response) = $this->apiMerchantV3TransactionGetWithHttpInfo($firstname, $lastname, $orderId, $pageSize, $page, $status, $minOrderValue, $maxOrderValue, $tId, $webshopIds);
        return $response;
    }

    /**
     * Operation apiMerchantV3TransactionGetWithHttpInfo
     *
     * Find transactions of a merchant according to some search parameters.
     *
     * @param  string|null $firstname (optional)
     * @param  string|null $lastname (optional)
     * @param  string|null $orderId (optional)
     * @param  int|null $pageSize (optional, default to 100)
     * @param  int|null $page (optional)
     * @param  string[]|null $status (optional)
     * @param  float|null $minOrderValue (optional)
     * @param  float|null $maxOrderValue (optional)
     * @param  string[]|null $tId Multiple unique functional transaction identifier (consists of 6 characters) provided through the query (optional)
     * @param  string[]|null $webshopIds (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Teambank\EasyCreditApiV3\Model\TransactionListInfo|\Teambank\EasyCreditApiV3\Model\ConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiMerchantV3TransactionGetWithHttpInfo($firstname = null, $lastname = null, $orderId = null, $pageSize = 100, $page = null, $status = null, $minOrderValue = null, $maxOrderValue = null, $tId = null, $webshopIds = null): array
    {
        $request = $this->apiMerchantV3TransactionGetRequest($firstname, $lastname, $orderId, $pageSize, $page, $status, $minOrderValue, $maxOrderValue, $tId, $webshopIds);

        try {
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $e) {
                if ($e instanceof NetworkExceptionInterface) {
                    // Propagate network-level failures (e.g. connection issues)
                    throw $e;
                }

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $responseHeaders = [];
                foreach ($response->getHeaders() as $name => $values) {
                    $responseHeaders[$name] = implode(', ', $values);
                }

                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $responseHeaders,
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\TransactionListInfo', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\ConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\AuthenticationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Teambank\EasyCreditApiV3\Model\TransactionListInfo';
            $content = (string) $response->getBody();

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\TransactionListInfo',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\ConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Create request for operation 'apiMerchantV3TransactionGet'
     *
     * @param  string|null $firstname (optional)
     * @param  string|null $lastname (optional)
     * @param  string|null $orderId (optional)
     * @param  int|null $pageSize (optional, default to 100)
     * @param  int|null $page (optional)
     * @param  string[]|null $status (optional)
     * @param  float|null $minOrderValue (optional)
     * @param  float|null $maxOrderValue (optional)
     * @param  string[]|null $tId Multiple unique functional transaction identifier (consists of 6 characters) provided through the query (optional)
     * @param  string[]|null $webshopIds (optional)
     *
     * @throws \InvalidArgumentException
     * @return Request
     */
    public function apiMerchantV3TransactionGetRequest($firstname = null, $lastname = null, $orderId = null, $pageSize = 100, $page = null, $status = null, $minOrderValue = null, $maxOrderValue = null, $tId = null, $webshopIds = null): Request
    {
        if ($tId !== null && count($tId) > 1000) {
            throw new \InvalidArgumentException('invalid value for "$tId" when calling TransactionApi.apiMerchantV3TransactionGet, number of items must be less than or equal to 1000.');
        }

        if ($webshopIds !== null && count($webshopIds) > 100) {
            throw new \InvalidArgumentException('invalid value for "$webshopIds" when calling TransactionApi.apiMerchantV3TransactionGet, number of items must be less than or equal to 100.');
        }


        $resourcePath = '/api/merchant/v3/transaction';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        // query params
        if ($firstname !== null) {
            $queryParams['firstname'] = $firstname;
        }
        // query params
        if ($lastname !== null) {
            $queryParams['lastname'] = $lastname;
        }
        // query params
        if ($orderId !== null) {
            $queryParams['orderId'] = $orderId;
        }
        // query params
        if ($pageSize !== null) {
            $queryParams['pageSize'] = $pageSize;
        }
        // query params
        if ($page !== null) {
            $queryParams['page'] = $page;
        }
        // query params
        if ($status !== null) {
            $queryParams['status'] = ObjectSerializer::serializeCollection(
                $status,
                'form',
                true
            );
        }
        // query params
        if ($minOrderValue !== null) {
            $queryParams['minOrderValue'] = $minOrderValue;
        }
        // query params
        if ($maxOrderValue !== null) {
            $queryParams['maxOrderValue'] = $maxOrderValue;
        }
        // query params
        if ($tId !== null) {
            $queryParams['tId'] = ObjectSerializer::serializeCollection(
                $tId,
                'form',
                true
            );
        }
        // query params
        if ($webshopIds !== null) {
            $queryParams['webshopIds'] = ObjectSerializer::serializeCollection(
                $webshopIds,
                'form',
                true
            );
        }



        $headers = $this->headerSelector->selectHeaders(
            ['application/hal+json', 'application/problem+json'],
            []
        );

        // for model (json/xml)

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        if (!empty($this->config->getAccessToken())) {
            $headers['Content-signature'] = 'hmacsha256=' . hash_hmac('sha256', $httpBody, $this->config->getAccessToken());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiMerchantV3TransactionTransactionIdCapturePost
     *
     * Report a capture for a transaction according to its unique functional identifier
     *
     * @param  string $transactionId Unique functional transaction identifier (consists of 6 characters) (required)
     * @param  \Teambank\EasyCreditApiV3\Model\CaptureRequest $captureRequest Capture Request Object (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiMerchantV3TransactionTransactionIdCapturePost($transactionId, $captureRequest = null)
    {
        $this->apiMerchantV3TransactionTransactionIdCapturePostWithHttpInfo($transactionId, $captureRequest);
    }

    /**
     * Operation apiMerchantV3TransactionTransactionIdCapturePostWithHttpInfo
     *
     * Report a capture for a transaction according to its unique functional identifier
     *
     * @param  string $transactionId Unique functional transaction identifier (consists of 6 characters) (required)
     * @param  \Teambank\EasyCreditApiV3\Model\CaptureRequest|null $captureRequest Capture Request Object (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiMerchantV3TransactionTransactionIdCapturePostWithHttpInfo($transactionId, $captureRequest = null): array
    {
        $request = $this->apiMerchantV3TransactionTransactionIdCapturePostRequest($transactionId, $captureRequest);

        try {
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $e) {
                if ($e instanceof NetworkExceptionInterface) {
                    // Propagate network-level failures (e.g. connection issues)
                    throw $e;
                }

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $responseHeaders = [];
                foreach ($response->getHeaders() as $name => $values) {
                    $responseHeaders[$name] = implode(', ', $values);
                }

                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $responseHeaders,
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\ConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 409:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Create request for operation 'apiMerchantV3TransactionTransactionIdCapturePost'
     *
     * @param  string $transactionId Unique functional transaction identifier (consists of 6 characters) (required)
     * @param  \Teambank\EasyCreditApiV3\Model\CaptureRequest|null $captureRequest Capture Request Object (optional)
     *
     * @throws \InvalidArgumentException
     * @return Request
     */
    public function apiMerchantV3TransactionTransactionIdCapturePostRequest($transactionId, $captureRequest = null): Request
    {

        $resourcePath = '/api/merchant/v3/transaction/{transactionId}/capture';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';



        // path params
        $resourcePath = str_replace(
            '{' . 'transactionId' . '}',
            ObjectSerializer::toPathValue($transactionId),
            $resourcePath
        );

        $headers = $this->headerSelector->selectHeaders(
            ['application/problem+json'],
            ['application/json']
        );

        // for model (json/xml)
        if (isset($captureRequest)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \json_encode(ObjectSerializer::sanitizeForSerialization($captureRequest));
            } else {
                $httpBody = $captureRequest;
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        if (!empty($this->config->getAccessToken())) {
            $headers['Content-signature'] = 'hmacsha256=' . hash_hmac('sha256', $httpBody, $this->config->getAccessToken());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiMerchantV3TransactionTransactionIdGet
     *
     * Retrieve a transaction of a merchant according to a unique functional identifier
     *
     * @param  string $transactionId Unique functional transaction identifier (consists of 6 characters) (required)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Teambank\EasyCreditApiV3\Model\TransactionResponse|\Teambank\EasyCreditApiV3\Model\ConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation
     */
    public function apiMerchantV3TransactionTransactionIdGet($transactionId)
    {
        list($response) = $this->apiMerchantV3TransactionTransactionIdGetWithHttpInfo($transactionId);
        return $response;
    }

    /**
     * Operation apiMerchantV3TransactionTransactionIdGetWithHttpInfo
     *
     * Retrieve a transaction of a merchant according to a unique functional identifier
     *
     * @param  string $transactionId Unique functional transaction identifier (consists of 6 characters) (required)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Teambank\EasyCreditApiV3\Model\TransactionResponse|\Teambank\EasyCreditApiV3\Model\ConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiMerchantV3TransactionTransactionIdGetWithHttpInfo($transactionId): array
    {
        $request = $this->apiMerchantV3TransactionTransactionIdGetRequest($transactionId);

        try {
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $e) {
                if ($e instanceof NetworkExceptionInterface) {
                    // Propagate network-level failures (e.g. connection issues)
                    throw $e;
                }

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $responseHeaders = [];
                foreach ($response->getHeaders() as $name => $values) {
                    $responseHeaders[$name] = implode(', ', $values);
                }

                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $responseHeaders,
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\TransactionResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\ConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\AuthenticationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Teambank\EasyCreditApiV3\Model\TransactionResponse';
            $content = (string) $response->getBody();

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\TransactionResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\ConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Create request for operation 'apiMerchantV3TransactionTransactionIdGet'
     *
     * @param  string $transactionId Unique functional transaction identifier (consists of 6 characters) (required)
     *
     * @throws \InvalidArgumentException
     * @return Request
     */
    public function apiMerchantV3TransactionTransactionIdGetRequest($transactionId): Request
    {

        $resourcePath = '/api/merchant/v3/transaction/{transactionId}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';



        // path params
        $resourcePath = str_replace(
            '{' . 'transactionId' . '}',
            ObjectSerializer::toPathValue($transactionId),
            $resourcePath
        );

        $headers = $this->headerSelector->selectHeaders(
            ['application/hal+json', 'application/problem+json'],
            []
        );

        // for model (json/xml)

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        if (!empty($this->config->getAccessToken())) {
            $headers['Content-signature'] = 'hmacsha256=' . hash_hmac('sha256', $httpBody, $this->config->getAccessToken());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiMerchantV3TransactionTransactionIdRefundPost
     *
     * Report a refund for a transaction according to its unique functional identifier
     *
     * @param  string $transactionId Unique functional transaction identifier (consists of 6 characters) (required)
     * @param  \Teambank\EasyCreditApiV3\Model\RefundRequest $refundRequest Refund Request Object (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiMerchantV3TransactionTransactionIdRefundPost($transactionId, $refundRequest = null)
    {
        $this->apiMerchantV3TransactionTransactionIdRefundPostWithHttpInfo($transactionId, $refundRequest);
    }

    /**
     * Operation apiMerchantV3TransactionTransactionIdRefundPostWithHttpInfo
     *
     * Report a refund for a transaction according to its unique functional identifier
     *
     * @param  string $transactionId Unique functional transaction identifier (consists of 6 characters) (required)
     * @param  \Teambank\EasyCreditApiV3\Model\RefundRequest|null $refundRequest Refund Request Object (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiMerchantV3TransactionTransactionIdRefundPostWithHttpInfo($transactionId, $refundRequest = null): array
    {
        $request = $this->apiMerchantV3TransactionTransactionIdRefundPostRequest($transactionId, $refundRequest);

        try {
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $e) {
                if ($e instanceof NetworkExceptionInterface) {
                    // Propagate network-level failures (e.g. connection issues)
                    throw $e;
                }

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $responseHeaders = [];
                foreach ($response->getHeaders() as $name => $values) {
                    $responseHeaders[$name] = implode(', ', $values);
                }

                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $responseHeaders,
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\ConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Create request for operation 'apiMerchantV3TransactionTransactionIdRefundPost'
     *
     * @param  string $transactionId Unique functional transaction identifier (consists of 6 characters) (required)
     * @param  \Teambank\EasyCreditApiV3\Model\RefundRequest|null $refundRequest Refund Request Object (optional)
     *
     * @throws \InvalidArgumentException
     * @return Request
     */
    public function apiMerchantV3TransactionTransactionIdRefundPostRequest($transactionId, $refundRequest = null): Request
    {

        $resourcePath = '/api/merchant/v3/transaction/{transactionId}/refund';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';



        // path params
        $resourcePath = str_replace(
            '{' . 'transactionId' . '}',
            ObjectSerializer::toPathValue($transactionId),
            $resourcePath
        );

        $headers = $this->headerSelector->selectHeaders(
            ['application/problem+json'],
            ['application/json']
        );

        // for model (json/xml)
        if (isset($refundRequest)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \json_encode(ObjectSerializer::sanitizeForSerialization($refundRequest));
            } else {
                $httpBody = $refundRequest;
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        if (!empty($this->config->getAccessToken())) {
            $headers['Content-signature'] = 'hmacsha256=' . hash_hmac('sha256', $httpBody, $this->config->getAccessToken());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiPaymentV3TransactionPost
     *
     * Initiates an ecommerce or direct sales transaction based on the given request
     *
     * @param  \Teambank\EasyCreditApiV3\Model\Transaction $transaction init request (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Teambank\EasyCreditApiV3\Model\TransactionInitResponse|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation
     */
    public function apiPaymentV3TransactionPost($transaction = null)
    {
        list($response) = $this->apiPaymentV3TransactionPostWithHttpInfo($transaction);
        return $response;
    }

    /**
     * Operation apiPaymentV3TransactionPostWithHttpInfo
     *
     * Initiates an ecommerce or direct sales transaction based on the given request
     *
     * @param  \Teambank\EasyCreditApiV3\Model\Transaction|null $transaction init request (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Teambank\EasyCreditApiV3\Model\TransactionInitResponse|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiPaymentV3TransactionPostWithHttpInfo($transaction = null): array
    {
        $request = $this->apiPaymentV3TransactionPostRequest($transaction);

        try {
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $e) {
                if ($e instanceof NetworkExceptionInterface) {
                    // Propagate network-level failures (e.g. connection issues)
                    throw $e;
                }

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $responseHeaders = [];
                foreach ($response->getHeaders() as $name => $values) {
                    $responseHeaders[$name] = implode(', ', $values);
                }

                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $responseHeaders,
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 201:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\TransactionInitResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\AuthenticationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Teambank\EasyCreditApiV3\Model\TransactionInitResponse';
            $content = (string) $response->getBody();

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\TransactionInitResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Create request for operation 'apiPaymentV3TransactionPost'
     *
     * @param  \Teambank\EasyCreditApiV3\Model\Transaction|null $transaction init request (optional)
     *
     * @throws \InvalidArgumentException
     * @return Request
     */
    public function apiPaymentV3TransactionPostRequest($transaction = null): Request
    {

        $resourcePath = '/api/payment/v3/transaction';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';




        $headers = $this->headerSelector->selectHeaders(
            ['application/hal+json', 'application/problem+json'],
            ['application/json']
        );

        // for model (json/xml)
        if (isset($transaction)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \json_encode(ObjectSerializer::sanitizeForSerialization($transaction));
            } else {
                $httpBody = $transaction;
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        if (!empty($this->config->getAccessToken())) {
            $headers['Content-signature'] = 'hmacsha256=' . hash_hmac('sha256', $httpBody, $this->config->getAccessToken());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiPaymentV3TransactionTechnicalTransactionIdAuthorizationPost
     *
     * Authorizes a transaction after finishing the process in a webshop
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     * @param  \Teambank\EasyCreditApiV3\Model\AuthorizationRequest $authorizationRequest authorization request (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdAuthorizationPost($technicalTransactionId, $authorizationRequest = null)
    {
        $this->apiPaymentV3TransactionTechnicalTransactionIdAuthorizationPostWithHttpInfo($technicalTransactionId, $authorizationRequest);
    }

    /**
     * Operation apiPaymentV3TransactionTechnicalTransactionIdAuthorizationPostWithHttpInfo
     *
     * Authorizes a transaction after finishing the process in a webshop
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     * @param  \Teambank\EasyCreditApiV3\Model\AuthorizationRequest|null $authorizationRequest authorization request (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdAuthorizationPostWithHttpInfo($technicalTransactionId, $authorizationRequest = null): array
    {
        $request = $this->apiPaymentV3TransactionTechnicalTransactionIdAuthorizationPostRequest($technicalTransactionId, $authorizationRequest);

        try {
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $e) {
                if ($e instanceof NetworkExceptionInterface) {
                    // Propagate network-level failures (e.g. connection issues)
                    throw $e;
                }

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $responseHeaders = [];
                foreach ($response->getHeaders() as $name => $values) {
                    $responseHeaders[$name] = implode(', ', $values);
                }

                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $responseHeaders,
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 409:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Create request for operation 'apiPaymentV3TransactionTechnicalTransactionIdAuthorizationPost'
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     * @param  \Teambank\EasyCreditApiV3\Model\AuthorizationRequest|null $authorizationRequest authorization request (optional)
     *
     * @throws \InvalidArgumentException
     * @return Request
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdAuthorizationPostRequest($technicalTransactionId, $authorizationRequest = null): Request
    {

        $resourcePath = '/api/payment/v3/transaction/{technicalTransactionId}/authorization';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';



        // path params
        $resourcePath = str_replace(
            '{' . 'technicalTransactionId' . '}',
            ObjectSerializer::toPathValue($technicalTransactionId),
            $resourcePath
        );

        $headers = $this->headerSelector->selectHeaders(
            ['application/problem+json'],
            ['application/json']
        );

        // for model (json/xml)
        if (isset($authorizationRequest)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \json_encode(ObjectSerializer::sanitizeForSerialization($authorizationRequest));
            } else {
                $httpBody = $authorizationRequest;
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        if (!empty($this->config->getAccessToken())) {
            $headers['Content-signature'] = 'hmacsha256=' . hash_hmac('sha256', $httpBody, $this->config->getAccessToken());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiPaymentV3TransactionTechnicalTransactionIdCancellationPost
     *
     * Cancel a transaction. This operation is only allowed for shops of type Direct Sales.
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdCancellationPost($technicalTransactionId)
    {
        $this->apiPaymentV3TransactionTechnicalTransactionIdCancellationPostWithHttpInfo($technicalTransactionId);
    }

    /**
     * Operation apiPaymentV3TransactionTechnicalTransactionIdCancellationPostWithHttpInfo
     *
     * Cancel a transaction. This operation is only allowed for shops of type Direct Sales.
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdCancellationPostWithHttpInfo($technicalTransactionId): array
    {
        $request = $this->apiPaymentV3TransactionTechnicalTransactionIdCancellationPostRequest($technicalTransactionId);

        try {
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $e) {
                if ($e instanceof NetworkExceptionInterface) {
                    // Propagate network-level failures (e.g. connection issues)
                    throw $e;
                }

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $responseHeaders = [];
                foreach ($response->getHeaders() as $name => $values) {
                    $responseHeaders[$name] = implode(', ', $values);
                }

                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $responseHeaders,
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 409:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Create request for operation 'apiPaymentV3TransactionTechnicalTransactionIdCancellationPost'
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     *
     * @throws \InvalidArgumentException
     * @return Request
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdCancellationPostRequest($technicalTransactionId): Request
    {

        $resourcePath = '/api/payment/v3/transaction/{technicalTransactionId}/cancellation';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';



        // path params
        $resourcePath = str_replace(
            '{' . 'technicalTransactionId' . '}',
            ObjectSerializer::toPathValue($technicalTransactionId),
            $resourcePath
        );

        $headers = $this->headerSelector->selectHeaders(
            ['application/problem+json'],
            []
        );

        // for model (json/xml)

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        if (!empty($this->config->getAccessToken())) {
            $headers['Content-signature'] = 'hmacsha256=' . hash_hmac('sha256', $httpBody, $this->config->getAccessToken());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiPaymentV3TransactionTechnicalTransactionIdGet
     *
     * Get the necessary information about the transaction
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Teambank\EasyCreditApiV3\Model\TransactionInformation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdGet($technicalTransactionId)
    {
        list($response) = $this->apiPaymentV3TransactionTechnicalTransactionIdGetWithHttpInfo($technicalTransactionId);
        return $response;
    }

    /**
     * Operation apiPaymentV3TransactionTechnicalTransactionIdGetWithHttpInfo
     *
     * Get the necessary information about the transaction
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Teambank\EasyCreditApiV3\Model\TransactionInformation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdGetWithHttpInfo($technicalTransactionId): array
    {
        $request = $this->apiPaymentV3TransactionTechnicalTransactionIdGetRequest($technicalTransactionId);

        try {
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $e) {
                if ($e instanceof NetworkExceptionInterface) {
                    // Propagate network-level failures (e.g. connection issues)
                    throw $e;
                }

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $responseHeaders = [];
                foreach ($response->getHeaders() as $name => $values) {
                    $responseHeaders[$name] = implode(', ', $values);
                }

                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $responseHeaders,
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\TransactionInformation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\AuthenticationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Teambank\EasyCreditApiV3\Model\TransactionInformation';
            $content = (string) $response->getBody();

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\TransactionInformation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Create request for operation 'apiPaymentV3TransactionTechnicalTransactionIdGet'
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     *
     * @throws \InvalidArgumentException
     * @return Request
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdGetRequest($technicalTransactionId): Request
    {

        $resourcePath = '/api/payment/v3/transaction/{technicalTransactionId}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';



        // path params
        $resourcePath = str_replace(
            '{' . 'technicalTransactionId' . '}',
            ObjectSerializer::toPathValue($technicalTransactionId),
            $resourcePath
        );

        $headers = $this->headerSelector->selectHeaders(
            ['application/hal+json', 'application/problem+json'],
            []
        );

        // for model (json/xml)

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        if (!empty($this->config->getAccessToken())) {
            $headers['Content-signature'] = 'hmacsha256=' . hash_hmac('sha256', $httpBody, $this->config->getAccessToken());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiPaymentV3TransactionTechnicalTransactionIdPatch
     *
     * Updates a transaction based on the given request
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     * @param  \Teambank\EasyCreditApiV3\Model\TransactionUpdate $transactionUpdate update request (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Teambank\EasyCreditApiV3\Model\TransactionSummary|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdPatch($technicalTransactionId, $transactionUpdate = null)
    {
        list($response) = $this->apiPaymentV3TransactionTechnicalTransactionIdPatchWithHttpInfo($technicalTransactionId, $transactionUpdate);
        return $response;
    }

    /**
     * Operation apiPaymentV3TransactionTechnicalTransactionIdPatchWithHttpInfo
     *
     * Updates a transaction based on the given request
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     * @param  \Teambank\EasyCreditApiV3\Model\TransactionUpdate|null $transactionUpdate update request (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Teambank\EasyCreditApiV3\Model\TransactionSummary|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdPatchWithHttpInfo($technicalTransactionId, $transactionUpdate = null): array
    {
        $request = $this->apiPaymentV3TransactionTechnicalTransactionIdPatchRequest($technicalTransactionId, $transactionUpdate);

        try {
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $e) {
                if ($e instanceof NetworkExceptionInterface) {
                    // Propagate network-level failures (e.g. connection issues)
                    throw $e;
                }

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $responseHeaders = [];
                foreach ($response->getHeaders() as $name => $values) {
                    $responseHeaders[$name] = implode(', ', $values);
                }

                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $responseHeaders,
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\TransactionSummary', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\AuthenticationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Teambank\EasyCreditApiV3\Model\TransactionSummary';
            $content = (string) $response->getBody();

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\TransactionSummary',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Create request for operation 'apiPaymentV3TransactionTechnicalTransactionIdPatch'
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     * @param  \Teambank\EasyCreditApiV3\Model\TransactionUpdate|null $transactionUpdate update request (optional)
     *
     * @throws \InvalidArgumentException
     * @return Request
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdPatchRequest($technicalTransactionId, $transactionUpdate = null): Request
    {

        $resourcePath = '/api/payment/v3/transaction/{technicalTransactionId}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';



        // path params
        $resourcePath = str_replace(
            '{' . 'technicalTransactionId' . '}',
            ObjectSerializer::toPathValue($technicalTransactionId),
            $resourcePath
        );

        $headers = $this->headerSelector->selectHeaders(
            ['application/hal+json', 'application/problem+json'],
            ['application/json']
        );

        // for model (json/xml)
        if (isset($transactionUpdate)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \json_encode(ObjectSerializer::sanitizeForSerialization($transactionUpdate));
            } else {
                $httpBody = $transactionUpdate;
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        if (!empty($this->config->getAccessToken())) {
            $headers['Content-signature'] = 'hmacsha256=' . hash_hmac('sha256', $httpBody, $this->config->getAccessToken());
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        return new Request(
            'PATCH',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiPaymentV3TransactionTechnicalTransactionIdSwitchPaymentMethodPost
     *
     * Switch payment method
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Teambank\EasyCreditApiV3\Model\TransactionInformation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdSwitchPaymentMethodPost($technicalTransactionId)
    {
        list($response) = $this->apiPaymentV3TransactionTechnicalTransactionIdSwitchPaymentMethodPostWithHttpInfo($technicalTransactionId);
        return $response;
    }

    /**
     * Operation apiPaymentV3TransactionTechnicalTransactionIdSwitchPaymentMethodPostWithHttpInfo
     *
     * Switch payment method
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Teambank\EasyCreditApiV3\Model\TransactionInformation|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation|\Teambank\EasyCreditApiV3\Model\AuthenticationError|\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdSwitchPaymentMethodPostWithHttpInfo($technicalTransactionId): array
    {
        $request = $this->apiPaymentV3TransactionTechnicalTransactionIdSwitchPaymentMethodPostRequest($technicalTransactionId);

        try {
            try {
                $response = $this->client->sendRequest($request);
            } catch (ClientExceptionInterface $e) {
                if ($e instanceof NetworkExceptionInterface) {
                    // Propagate network-level failures (e.g. connection issues)
                    throw $e;
                }

                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $responseHeaders = [];
                foreach ($response->getHeaders() as $name => $values) {
                    $responseHeaders[$name] = implode(', ', $values);
                }

                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $responseHeaders,
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\TransactionInformation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\AuthenticationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Teambank\EasyCreditApiV3\Model\TransactionInformation';
            $content = (string) $response->getBody();

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\TransactionInformation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\PaymentConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Create request for operation 'apiPaymentV3TransactionTechnicalTransactionIdSwitchPaymentMethodPost'
     *
     * @param  string $technicalTransactionId Unique TeamBank transaction identifier (required)
     *
     * @throws \InvalidArgumentException
     * @return Request
     */
    public function apiPaymentV3TransactionTechnicalTransactionIdSwitchPaymentMethodPostRequest($technicalTransactionId): Request
    {

        $resourcePath = '/api/payment/v3/transaction/{technicalTransactionId}/switchPaymentMethod';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';



        // path params
        $resourcePath = str_replace(
            '{' . 'technicalTransactionId' . '}',
            ObjectSerializer::toPathValue($technicalTransactionId),
            $resourcePath
        );

        $headers = $this->headerSelector->selectHeaders(
            ['application/hal+json', 'application/problem+json'],
            []
        );

        // for model (json/xml)


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = http_build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

}
