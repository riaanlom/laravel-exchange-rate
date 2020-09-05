<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

use Illuminate\Validation\ValidationException;
use GuzzleHttp\Exception\RequestException;
use Yoelpc4\LaravelExchangeRate\Currency;
use Yoelpc4\LaravelExchangeRate\ExchangeRate;

interface ExchangeRateProvider
{
    /**
     * Get supported currencies
     *
     * @return Currency[]
     * @throws RequestException
     */
    public function currencies();

    /**
     * Get latest exchange rate(s)
     *
     * @param  string  $base
     * @param  string|array  $symbols
     * @return ExchangeRate[]
     * @throws RequestException
     * @throws ValidationException
     */
    public function latest(string $base, $symbols);

    /**
     * Get historical exchange rate(s)
     *
     * @param  string  $base
     * @param  string|array  $symbols
     * @param  string  $date
     * @return ExchangeRate[]
     * @throws RequestException
     * @throws ValidationException
     */
    public function historical(string $base, $symbols, string $date);

    /**
     * Get time series exchange rate(s)
     *
     * @param  string  $base
     * @param  string|array  $symbols
     * @param  string  $startDate
     * @param  string  $endDate
     * @return ExchangeRate[]
     * @throws RequestException
     * @throws ValidationException
     */
    public function timeSeries(string $base, $symbols, string $startDate, string $endDate);
}
