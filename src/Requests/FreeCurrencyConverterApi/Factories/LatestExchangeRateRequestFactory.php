<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Factories;

use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\LatestExchangeRateRequestFactory as LatestRequestFactoryContract;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\LatestExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Util;

class LatestExchangeRateRequestFactory implements LatestRequestFactoryContract
{
    use Util;

    /**
     * @inheritDoc
     */
    public function make(string $base, $symbols)
    {
        $base = strtoupper($base);

        $symbols = $this->makeSymbols($symbols);

        return new LatestExchangeRateRequest($base, $symbols);
    }
}
