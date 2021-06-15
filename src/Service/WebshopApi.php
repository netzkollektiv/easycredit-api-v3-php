<?php
/**
 * WebshopApi
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

namespace Teambank\RatenkaufByEasyCreditApiV3\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Teambank\RatenkaufByEasyCreditApiV3\ApiException;
use Teambank\RatenkaufByEasyCreditApiV3\Configuration;
use Teambank\RatenkaufByEasyCreditApiV3\HeaderSelector;
use Teambank\RatenkaufByEasyCreditApiV3\ObjectSerializer;

/**
 * WebshopApi Class Doc Comment
 *
 * @category Class
 * @package  Teambank\RatenkaufByEasyCreditApiV3
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class WebshopApi
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
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
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
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation apiPaymentV3WebshopGet
     *
     * Get the necessary information about the webshop
     *
     *
     * @throws \Teambank\RatenkaufByEasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Teambank\RatenkaufByEasyCreditApiV3\Model\WebshopResponse|\Teambank\RatenkaufByEasyCreditApiV3\Model\AuthenticationError|\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation
     */
    public function apiPaymentV3WebshopGet()
    {
        list($response) = $this->apiPaymentV3WebshopGetWithHttpInfo();
        return $response;
    }

    /**
     * Operation apiPaymentV3WebshopGetWithHttpInfo
     *
     * Get the necessary information about the webshop
     *
     *
     * @throws \Teambank\RatenkaufByEasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Teambank\RatenkaufByEasyCreditApiV3\Model\WebshopResponse|\Teambank\RatenkaufByEasyCreditApiV3\Model\AuthenticationError|\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiPaymentV3WebshopGetWithHttpInfo()
    {
        $request = $this->apiPaymentV3WebshopGetRequest();

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Teambank\RatenkaufByEasyCreditApiV3\Model\WebshopResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\RatenkaufByEasyCreditApiV3\Model\WebshopResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\Teambank\RatenkaufByEasyCreditApiV3\Model\AuthenticationError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\RatenkaufByEasyCreditApiV3\Model\AuthenticationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    if ('\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Teambank\RatenkaufByEasyCreditApiV3\Model\WebshopResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

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
                        '\Teambank\RatenkaufByEasyCreditApiV3\Model\WebshopResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\RatenkaufByEasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiPaymentV3WebshopGetAsync
     *
     * Get the necessary information about the webshop
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiPaymentV3WebshopGetAsync()
    {
        return $this->apiPaymentV3WebshopGetAsyncWithHttpInfo()
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiPaymentV3WebshopGetAsyncWithHttpInfo
     *
     * Get the necessary information about the webshop
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiPaymentV3WebshopGetAsyncWithHttpInfo()
    {
        $returnType = '\Teambank\RatenkaufByEasyCreditApiV3\Model\WebshopResponse';
        $request = $this->apiPaymentV3WebshopGetRequest();

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiPaymentV3WebshopGet'
     *
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiPaymentV3WebshopGetRequest()
    {

        $resourcePath = '/api/payment/v3/webshop';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
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

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation apiPaymentV3WebshopIntegrationcheckPost
     *
     * Verifies the correctness of the merchant&#39;s authentication credentials and, if enabled, the body signature
     *
     * @param  \Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckRequest $integrationCheckRequest integration check request (optional)
     *
     * @throws \Teambank\RatenkaufByEasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckResponse|\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation|\Teambank\RatenkaufByEasyCreditApiV3\Model\AuthenticationError|\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation
     */
    public function apiPaymentV3WebshopIntegrationcheckPost($integrationCheckRequest = null)
    {
        list($response) = $this->apiPaymentV3WebshopIntegrationcheckPostWithHttpInfo($integrationCheckRequest);
        return $response;
    }

    /**
     * Operation apiPaymentV3WebshopIntegrationcheckPostWithHttpInfo
     *
     * Verifies the correctness of the merchant&#39;s authentication credentials and, if enabled, the body signature
     *
     * @param  \Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckRequest $integrationCheckRequest integration check request (optional)
     *
     * @throws \Teambank\RatenkaufByEasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckResponse|\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation|\Teambank\RatenkaufByEasyCreditApiV3\Model\AuthenticationError|\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiPaymentV3WebshopIntegrationcheckPostWithHttpInfo($integrationCheckRequest = null)
    {
        $request = $this->apiPaymentV3WebshopIntegrationcheckPostRequest($integrationCheckRequest);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\Teambank\RatenkaufByEasyCreditApiV3\Model\AuthenticationError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\RatenkaufByEasyCreditApiV3\Model\AuthenticationError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    if ('\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

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
                        '\Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\RatenkaufByEasyCreditApiV3\Model\AuthenticationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\RatenkaufByEasyCreditApiV3\Model\ConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation apiPaymentV3WebshopIntegrationcheckPostAsync
     *
     * Verifies the correctness of the merchant&#39;s authentication credentials and, if enabled, the body signature
     *
     * @param  \Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckRequest $integrationCheckRequest integration check request (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiPaymentV3WebshopIntegrationcheckPostAsync($integrationCheckRequest = null)
    {
        return $this->apiPaymentV3WebshopIntegrationcheckPostAsyncWithHttpInfo($integrationCheckRequest)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation apiPaymentV3WebshopIntegrationcheckPostAsyncWithHttpInfo
     *
     * Verifies the correctness of the merchant&#39;s authentication credentials and, if enabled, the body signature
     *
     * @param  \Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckRequest $integrationCheckRequest integration check request (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function apiPaymentV3WebshopIntegrationcheckPostAsyncWithHttpInfo($integrationCheckRequest = null)
    {
        $returnType = '\Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckResponse';
        $request = $this->apiPaymentV3WebshopIntegrationcheckPostRequest($integrationCheckRequest);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'apiPaymentV3WebshopIntegrationcheckPost'
     *
     * @param  \Teambank\RatenkaufByEasyCreditApiV3\Model\IntegrationCheckRequest $integrationCheckRequest integration check request (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function apiPaymentV3WebshopIntegrationcheckPostRequest($integrationCheckRequest = null)
    {

        $resourcePath = '/api/payment/v3/webshop/integrationcheck';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($integrationCheckRequest)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($integrationCheckRequest));
            } else {
                $httpBody = $integrationCheckRequest;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
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

        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
