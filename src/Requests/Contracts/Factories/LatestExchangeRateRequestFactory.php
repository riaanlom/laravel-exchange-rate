<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories;

use Yoelpc4\LaravelExchangeRate\Requests\Contracts\LatestExchangeRateRequest;

interface LatestExchangeRateRequestFactory
{
    /**
     * Create a new latest exchange rate request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @return LatestExchangeRateRequest
     */
    public function make(string $base, $symbols);
}
