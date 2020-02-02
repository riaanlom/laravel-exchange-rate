<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Apis;

interface ApiFactoryContract
{
    /**
     * Create a new instance of api
     *
     * @param  string  $baseUri
     * @return ApiContract
     */
    public function make(string $baseUri);
}
