<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\LatestExchangeRate as LatestExchangeRateContract;
use Yoelpc4\LaravelExchangeRate\Rate;

class LatestExchangeRate extends ExchangeRate implements LatestExchangeRateContract
{
    /**
     * LatestExchangeRate constructor.
     *
     * @param  string  $base
     * @param  array  $symbols
     * @param  Rate[]  $rates
     */
    public function __construct(string $base, array $symbols, $rates)
    {
        $this->base = $base;

        $this->symbols = $symbols;

        $this->rates = $rates;
    }
}
