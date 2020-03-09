<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Api;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\Base\BaseRequestInterface;

interface ApiInterface
{
    /**
     * Handle an outgoing request.
     *
     * @param  BaseRequestInterface  $request
     * @return ResponseInterface
     * @throws RequestException
     */
    public function handle(BaseRequestInterface $request);
}
