<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates;

use Yoelpc4\LaravelExchangeRate\Contracts\Requests\LatestExchangeRateRequest;

interface LatestExchangeRateFactory
{
    /**
     * Create a new latest exchange rate instance.
     *
     * @param  LatestExchangeRateRequest  $request
     * @param  string  $contents
     * @return LatestExchangeRate
     */
    public function make(LatestExchangeRateRequest $request, string $contents);
}
