<?php

/**
 * 
 *
 * @category Class
 * @package  Teambank\EasyCreditApiV3
 *
 * Transaction-V3 API Definition
 * @author   NETZKOLLEKTIV GmbH
 * @link     https://netzkollektiv.com
 */

namespace Teambank\EasyCreditApiV3;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class Client implements ClientInterface
{
    protected $logger;

    public function __construct($logger = null)
    {
        $this->logger = $logger;
    }

    protected function parseHeaders($headers)
    {
        $_headers = array();
        foreach ($headers as $key => $value) {
            $t = explode(':', $value, 2);
            if (isset($t[1])) {
                $_headers[trim($t[0])] = trim($t[1]);
                continue;
            }
        }
        return $_headers;
    }

    protected function parseStatusHeader($headers)
    {
        foreach ($headers as $value) {
            if (preg_match("#HTTP/([0-9\.]+)\s+([0-9]+)\s?(.*)#", $value, $matches)) {
                return array(
                    'version' => $matches[1],
                    'status' => (int) $matches[2],
                    'reason' => !empty($matches[3]) ? $matches[3] : null
                );
            }
        }
        return array(
            'version' => '1.1',
            'status' => 0,
            'reason' => null
        );
    }

    /**
     * Sends a PSR-7 request and returns a PSR-7 response.
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws \Psr\Http\Client\ClientExceptionInterface If an error happens while processing the request.
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {

        $_headers = array();
        foreach ($request->getHeaders() as $name => $values) {
            $_headers[] = $name . ": " . implode(", ", $values);
        }

        $context = array(
            'http' => array(
                'method' => $request->getMethod(),
                'header' => implode("\r\n", $_headers),
                'protocol_version' => $request->getProtocolVersion(),
                'timeout' => 10,
                'ignore_errors' => true
            )
        );

        $body = (string)$request->getBody();
        if ($body !== '') {
            $context['http']['content'] = $body;
        }

        $stream = @fopen((string)$request->getUri(), 'rb', false, stream_context_create($context));
        if ($stream === false) {
            $error = error_get_last();
            $message = $error['message'] ?? 'Network request failed';
            throw new NetworkException(
                sprintf('Unable to connect to %s: %s', $request->getUri()->getHost(), $message),
                $request
            );
        }
        $meta = stream_get_meta_data($stream);
        $responseBody = stream_get_contents($stream);
        fclose($stream);

        if ($responseBody === false) {
            $responseBody = '';
        }

        $rawHeaders = [];
        if (isset($meta['wrapper_data']) && is_array($meta['wrapper_data'])) {
            $rawHeaders = $meta['wrapper_data'];
        }

        $responseHeaders = $this->parseHeaders($rawHeaders);
        $statusHeader = $this->parseStatusHeader($rawHeaders);

        $response = new Response(
            $statusHeader['status'],
            $responseHeaders,
            $responseBody,
            $statusHeader['version'],
            $statusHeader['reason']
        );

        $this->handleLog(
            $request,
            $response
        );

        if ($statusHeader['status'] === 400) {
            $match = preg_match('#Support-ID:\s+(\d+)#', $responseBody, $matches);
            if ($match) {
                throw new ApiException(
                    sprintf('Bad Request (Support-ID: %s)', $matches[1]),
                    400,
                    $responseHeaders,
                    $responseBody
                );
            }
        }
        return $response;
    }

    protected function handleLog(RequestInterface $request, ResponseInterface $response)
    {
        if (!$this->logger) {
            return;
        }

        $logFunction = 'debug';
        if ($response->getStatusCode() < 200 || $response->getStatusCode() > 299) {
            $logFunction = 'error';
        }

        $this->logger->$logFunction(
            "\"{$request->getMethod()} {$request->getUri()} HTTP/{$request->getProtocolVersion()}\" {$response->getStatusCode()} {$response->getReasonPhrase()}"
        );
        $this->logger->$logFunction(
            ">>>>>>>>\n{$request->getBody()}\n<<<<<<<<\n{$response->getBody()}\n--------"
        );
    }
}
