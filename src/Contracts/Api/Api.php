<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Api;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\Requestable;

interface Api
{
    /**
     * Handle an outgoing request.
     *
     * @param  Requestable  $requestable
     * @return ResponseInterface
     * @throws RequestException
     */
    public function handle(Requestable $requestable);
}
