<?php

namespace Yoelpc4\LaravelExchangeRate\Api;

use Yoelpc4\LaravelExchangeRate\Contracts\Api\Factory;

class ApiManager implements Factory
{
    /**
     * @inheritDoc
     */
    public function make(string $baseUrl)
    {
        return new GuzzleHttpApi($baseUrl);
    }
}
