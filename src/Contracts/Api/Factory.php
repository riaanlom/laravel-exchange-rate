<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Api;

interface Factory
{
    /**
     * Create a new api instance
     *
     * @param  string  $baseUrl
     * @return Api
     */
    public function make(string $baseUrl);
}
