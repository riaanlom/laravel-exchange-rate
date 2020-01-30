<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Apis;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\Request;

interface Api
{
    /**
     * Handle an outgoing request.
     *
     * @param  Request  $request
     * @return ResponseInterface
     * @throws RequestException
     */
    public function handle(Request $request);
}
