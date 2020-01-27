<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories;

use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\HistoricalExchangeRateRequest;

interface HistoricalExchangeRateRequestFactory
{
    /**
     * Create a new historical exchange rate handle instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $date
     * @return HistoricalExchangeRateRequest
     */
    public function make(string $base, $symbols, string $date);
}
