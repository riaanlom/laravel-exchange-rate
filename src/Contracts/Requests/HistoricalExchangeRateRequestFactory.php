<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Requests;

interface HistoricalExchangeRateRequestFactory
{
    /**
     * Create a new historical exchange rate request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $date
     * @return HistoricalExchangeRateRequest
     */
    public function make(string $base, $symbols, string $date);
}
