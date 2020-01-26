<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Factories;

use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\TimeSeriesExchangeRateRequestFactory as TimeSeriesRequestFactoryContract;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\TimeSeriesExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Util;

class TimeSeriesExchangeRateRequestFactory implements TimeSeriesRequestFactoryContract
{
    use Util;

    /**
     * @inheritDoc
     */
    public function make(string $base, $symbols, string $startDate, string $endDate)
    {
        $base = strtoupper($base);

        $symbols = $this->makeSymbols($symbols);

        return new TimeSeriesExchangeRateRequest($base, $symbols, $startDate, $endDate);
    }
}
