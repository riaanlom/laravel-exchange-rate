<?php

namespace Yoelpc4\LaravelExchangeRate\Apis\GuzzleHttp;

use Yoelpc4\LaravelExchangeRate\Contracts\Api\ApiFactoryInterface;

class ApiFactory implements ApiFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function make(string $baseUri)
    {
        return new Api($baseUri);
    }
}
