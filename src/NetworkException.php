<?php
/**
 * NetworkException
 *
 * @category Class
 * @package  Teambank\EasyCreditApiV3
 *
 * Transaction-V3 API Definition
 */

namespace Teambank\EasyCreditApiV3;

use Exception;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Throwable;

/**
 * NetworkException Class
 *
 * @category Class
 * @package  Teambank\EasyCreditApiV3
 */
class NetworkException extends Exception implements NetworkExceptionInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param string           $message  Error message
     * @param RequestInterface $request  Request that triggered the exception
     * @param int              $code     Error code
     * @param Throwable|null   $previous Previous exception
     */
    public function __construct(
        string $message,
        RequestInterface $request,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->request = $request;
    }

    /**
     * Returns the request that caused the exception.
     *
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}

