<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories;

use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\TimeSeriesRequest;

interface TimeSeriesRequestFactory
{
    /**
     * Create a new time series request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $startDate
     * @param  string  $endDate
     * @return TimeSeriesRequest
     * @throws ValidationException
     */
    public function make(string $base, $symbols, string $startDate, string $endDate);
}
