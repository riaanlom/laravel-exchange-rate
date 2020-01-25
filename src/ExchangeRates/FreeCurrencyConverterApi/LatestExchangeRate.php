<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\LatestExchangeRate as LatestExchangeRateContract;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Rate;

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
