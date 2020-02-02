<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Apis;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\Base\BaseRequestContract;

interface ApiContract
{
    /**
     * Handle an outgoing request.
     *
     * @param  BaseRequestContract  $request
     * @return ResponseInterface
     * @throws RequestException
     */
    public function handle(BaseRequestContract $request);
}
