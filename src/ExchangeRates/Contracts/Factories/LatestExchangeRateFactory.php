<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\LatestExchangeRate;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\LatestRequest;

interface LatestExchangeRateFactory
{
    /**
     * Create a new latest exchange rate instance.
     *
     * @param  LatestRequest  $request
     * @param  string  $contents
     * @return LatestExchangeRate
     */
    public function make(LatestRequest $request, string $contents);
}
