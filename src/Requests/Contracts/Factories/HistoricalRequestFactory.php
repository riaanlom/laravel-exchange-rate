<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories;

use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\HistoricalRequest;

interface HistoricalRequestFactory
{
    /**
     * Create a new historical request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $date
     * @return HistoricalRequest
     * @throws ValidationException
     */
    public function make(string $base, $symbols, string $date);
}
