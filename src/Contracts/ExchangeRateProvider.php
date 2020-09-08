<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\ValidationException;
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
     * @param  string|array  $targets
     * @return ExchangeRate[]
     * @throws RequestException
     * @throws ValidationException
     */
    public function latest(string $base, $targets);

    /**
     * Get historical exchange rate(s)
     *
     * @param  string  $base
     * @param  string|array  $targets
     * @param  string  $date
     * @return ExchangeRate[]
     * @throws RequestException
     * @throws ValidationException
     */
    public function historical(string $base, $targets, string $date);

    /**
     * Get time series exchange rate(s)
     *
     * @param  string  $base
     * @param  string|array  $targets
     * @param  string  $startDate
     * @param  string  $endDate
     * @return ExchangeRate[]
     * @throws RequestException
     * @throws ValidationException
     */
    public function timeSeries(string $base, $targets, string $startDate, string $endDate);
}
