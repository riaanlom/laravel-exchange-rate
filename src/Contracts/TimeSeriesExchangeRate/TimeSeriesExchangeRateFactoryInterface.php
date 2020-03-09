<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate;

interface TimeSeriesExchangeRateFactoryInterface
{
    /**
     * Create a new time series exchange rate request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $startDate
     * @param  string  $endDate
     * @return TimeSeriesExchangeRateRequestInterface
     */
    public function makeRequest(string $base, $symbols, string $startDate, string $endDate);

    /**
     * Create a new time series exchange rate response instance.
     *
     * @param  TimeSeriesExchangeRateRequestInterface  $request
     * @param  string  $contents
     * @return TimeSeriesExchangeRateResponseInterface
     */
    public function makeResponse(TimeSeriesExchangeRateRequestInterface $request, string $contents);
}
