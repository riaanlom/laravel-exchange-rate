<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates;

use Yoelpc4\LaravelExchangeRate\Contracts\Requests\TimeSeriesExchangeRateRequest;

interface TimeSeriesExchangeRateFactory
{
    /**
     * Create a new time series exchange rate instance.
     *
     * @param  TimeSeriesExchangeRateRequest  $request
     * @param  string  $contents
     * @return TimeSeriesExchangeRate
     */
    public function make(TimeSeriesExchangeRateRequest $request, string $contents);
}
