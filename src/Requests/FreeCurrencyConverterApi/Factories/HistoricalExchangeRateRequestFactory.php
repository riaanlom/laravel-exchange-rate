<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Factories;

use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\HistoricalExchangeRateRequestFactory as HistoricalRequestFactoryContract;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\HistoricalExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Util;

class HistoricalExchangeRateRequestFactory implements HistoricalRequestFactoryContract
{
    use Util;

    /**
     * @inheritDoc
     */
    public function make(string $base, $symbols, string $date)
    {
        $base = strtoupper($base);

        $symbols = $this->makeSymbols($symbols);

        return new HistoricalExchangeRateRequest($base, $symbols, $date);
    }
}
