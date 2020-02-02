<?php

namespace Yoelpc4\LaravelExchangeRate\Apis\Guzzle;

use Yoelpc4\LaravelExchangeRate\Apis\Api;
use Yoelpc4\LaravelExchangeRate\Contracts\Apis\ApiFactoryContract;

class ApiFactory implements ApiFactoryContract
{
    /**
     * @inheritDoc
     */
    public function make(string $baseUri)
    {
        return new Api($baseUri);
    }
}
