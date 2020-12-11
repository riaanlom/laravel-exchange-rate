<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Api;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\Requestable;

interface Api
{
    /**
     * Handle an outgoing request.
     *
     * @param  Requestable  $request
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function handle(Requestable $request);
}
