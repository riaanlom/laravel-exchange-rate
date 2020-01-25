<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\TimeSeriesExchangeRate;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\TimeSeriesRequest;

interface TimeSeriesExchangeRateFactory
{
    /**
     * Create a new time series exchange rate instance.
     *
     * @param  TimeSeriesRequest  $request
     * @param  string  $contents
     * @return TimeSeriesExchangeRate
     */
    public function make(TimeSeriesRequest $request, string $contents);
}
