<?php

namespace Yoelpc4\LaravelExchangeRate\LatestExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Base\FreeCurrencyConverterApi\BaseResponse;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateResponseInterface;
use Yoelpc4\LaravelExchangeRate\Rate;

class LatestExchangeRateResponse extends BaseResponse implements LatestExchangeRateResponseInterface
{
    /**
     * LatestExchangeRateResponse constructor.
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
