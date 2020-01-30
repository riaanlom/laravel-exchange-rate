<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Requests;

interface TimeSeriesExchangeRateRequestFactory
{
    /**
     * Create a new time series exchange rate request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $startDate
     * @param  string  $endDate
     * @return TimeSeriesExchangeRateRequest
     */
    public function make(string $base, $symbols, string $startDate, string $endDate);
}
