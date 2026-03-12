<?php
/**
 * InstallmentplanApi
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
 * InstallmentplanApi Class
 *
 * @category Class
 * @package  Teambank\EasyCreditApiV3
 */
class InstallmentplanApi
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
     * Operation apiRatenrechnerV3WebshopShopIdentifierInstallmentplansPost
     *
     * Calculates the installmentplan
     *
     * @param  string $shopIdentifier Shop Identifier (required)
     * @param  \Teambank\EasyCreditApiV3\Model\InstallmentPlanRequest $installmentPlanRequest integration check request (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Teambank\EasyCreditApiV3\Model\InstallmentPlanResponse|\Teambank\EasyCreditApiV3\Model\ConstraintViolation|\Teambank\EasyCreditApiV3\Model\ConstraintViolation
     */
    public function apiRatenrechnerV3WebshopShopIdentifierInstallmentplansPost($shopIdentifier, $installmentPlanRequest = null)
    {
        list($response) = $this->apiRatenrechnerV3WebshopShopIdentifierInstallmentplansPostWithHttpInfo($shopIdentifier, $installmentPlanRequest);
        return $response;
    }

    /**
     * Operation apiRatenrechnerV3WebshopShopIdentifierInstallmentplansPostWithHttpInfo
     *
     * Calculates the installmentplan
     *
     * @param  string $shopIdentifier Shop Identifier (required)
     * @param  \Teambank\EasyCreditApiV3\Model\InstallmentPlanRequest|null $installmentPlanRequest integration check request (optional)
     *
     * @throws \Teambank\EasyCreditApiV3\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Teambank\EasyCreditApiV3\Model\InstallmentPlanResponse|\Teambank\EasyCreditApiV3\Model\ConstraintViolation|\Teambank\EasyCreditApiV3\Model\ConstraintViolation, HTTP status code, HTTP response headers (array of strings)
     */
    public function apiRatenrechnerV3WebshopShopIdentifierInstallmentplansPostWithHttpInfo($shopIdentifier, $installmentPlanRequest = null): array
    {
        $request = $this->apiRatenrechnerV3WebshopShopIdentifierInstallmentplansPostRequest($shopIdentifier, $installmentPlanRequest);

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
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\InstallmentPlanResponse', []),
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
                case 404:
                    $content = (string) $response->getBody();

                    return [
                        ObjectSerializer::deserialize($content, '\Teambank\EasyCreditApiV3\Model\ConstraintViolation', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Teambank\EasyCreditApiV3\Model\InstallmentPlanResponse';
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
                        '\Teambank\EasyCreditApiV3\Model\InstallmentPlanResponse',
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
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Teambank\EasyCreditApiV3\Model\ConstraintViolation',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Create request for operation 'apiRatenrechnerV3WebshopShopIdentifierInstallmentplansPost'
     *
     * @param  string $shopIdentifier Shop Identifier (required)
     * @param  \Teambank\EasyCreditApiV3\Model\InstallmentPlanRequest|null $installmentPlanRequest integration check request (optional)
     *
     * @throws \InvalidArgumentException
     * @return Request
     */
    public function apiRatenrechnerV3WebshopShopIdentifierInstallmentplansPostRequest($shopIdentifier, $installmentPlanRequest = null): Request
    {

        $resourcePath = '/api/ratenrechner/v3/webshop/{shopIdentifier}/installmentplans';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';



        // path params
        $resourcePath = str_replace(
            '{' . 'shopIdentifier' . '}',
            ObjectSerializer::toPathValue($shopIdentifier),
            $resourcePath
        );

        $headers = $this->headerSelector->selectHeaders(
            ['application/problem+json'],
            ['application/json']
        );

        // for model (json/xml)
        if (isset($installmentPlanRequest)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \json_encode(ObjectSerializer::sanitizeForSerialization($installmentPlanRequest));
            } else {
                $httpBody = $installmentPlanRequest;
            }
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

}
