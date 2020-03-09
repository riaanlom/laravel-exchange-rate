<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Api;

interface ApiFactoryInterface
{
    /**
     * Create a new instance of api
     *
     * @param  string  $baseUri
     * @return ApiInterface
     */
    public function make(string $baseUri);
}
