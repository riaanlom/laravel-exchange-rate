<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\Requests\TimeSeriesExchangeRateRequestFactory;

class TimeSeriesExchangeRateRequestManager implements TimeSeriesExchangeRateRequestFactory
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
