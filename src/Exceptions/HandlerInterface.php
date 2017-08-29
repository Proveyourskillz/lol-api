<?php namespace Likewinter\LolApi\Exceptions;

use GuzzleHttp\Exception\RequestException;
use Likewinter\LolApi\ApiRequest\ApiRequestInterface;

interface HandlerInterface
{
    /**
     * @param RequestException $requestException
     * @param ApiRequestInterface $apiRequest
     * @throws \Exception
     */
    public function handle(RequestException $requestException, ApiRequestInterface $apiRequest): void;
}