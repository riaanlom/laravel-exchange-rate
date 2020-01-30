<?php

namespace Yoelpc4\LaravelExchangeRate\Apis\Guzzle;

use Yoelpc4\LaravelExchangeRate\Apis\Api;
use Yoelpc4\LaravelExchangeRate\Contracts\Apis\Factory;

class ApiManager implements Factory
{
    /**
     * @inheritDoc
     */
    public function make(string $baseUri)
    {
        return new Api($baseUri);
    }
}
