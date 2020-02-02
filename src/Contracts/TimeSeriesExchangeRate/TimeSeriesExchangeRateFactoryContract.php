<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate;

interface TimeSeriesExchangeRateFactoryContract
{
    /**
     * Create a new time series exchange rate request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $startDate
     * @param  string  $endDate
     * @return TimeSeriesExchangeRateRequestContract
     */
    public function makeRequest(string $base, $symbols, string $startDate, string $endDate);

    /**
     * Create a new time series exchange rate response instance.
     *
     * @param  TimeSeriesExchangeRateRequestContract  $request
     * @param  string  $contents
     * @return TimeSeriesExchangeRateResponseContract
     */
    public function makeResponse(TimeSeriesExchangeRateRequestContract $request, string $contents);
}
