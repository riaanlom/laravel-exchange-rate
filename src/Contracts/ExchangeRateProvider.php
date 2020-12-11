<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

use Illuminate\Validation\ValidationException;
use Psr\Http\Client\ClientExceptionInterface;

interface ExchangeRateProvider
{
    /**
     * Get supported currencies
     *
     * @return SupportedCurrenciesInterface
     * @throws ClientExceptionInterface
     */
    public function currencies();

    /**
     * Get latest exchange rates
     *
     * @param  string  $base
     * @param  string|array  $targets
     * @return LatestExchangeRateInterface
     * @throws ValidationException
     * @throws ClientExceptionInterface
     */
    public function latest(string $base, $targets);

    /**
     * Get historical exchange rates
     *
     * @param  string  $base
     * @param  string|array  $targets
     * @param  string  $date
     * @return HistoricalExchangeRateInterface
     * @throws ValidationException
     * @throws ClientExceptionInterface
     */
    public function historical(string $base, $targets, string $date);

    /**
     * Get time series exchange rates
     *
     * @param  string  $base
     * @param  string|array  $targets
     * @param  string  $startDate
     * @param  string  $endDate
     * @return TimeSeriesExchangeRateInterface
     * @throws ValidationException
     * @throws ClientExceptionInterface
     */
    public function timeSeries(string $base, $targets, string $startDate, string $endDate);
}
