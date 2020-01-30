<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Services;

use GuzzleHttp\Exception\RequestException;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\SupportedCurrencies;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\HistoricalExchangeRate;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\LatestExchangeRate;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\TimeSeriesExchangeRate;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\HistoricalExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\LatestExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\SupportedCurrenciesRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\TimeSeriesExchangeRateRequest;

interface Service
{
    /**
     * Get the supported currencies data
     *
     * @param  SupportedCurrenciesRequest  $request
     * @return SupportedCurrencies
     * @throws RequestException
     */
    public function supportedCurrencies(SupportedCurrenciesRequest $request);

    /**
     * Get the latest exchange rate data
     *
     * @param  LatestExchangeRateRequest  $request
     * @return LatestExchangeRate
     * @throws RequestException
     */
    public function latest(LatestExchangeRateRequest $request);

    /**
     * Get the historical exchange rate data
     *
     * @param  HistoricalExchangeRateRequest  $request
     * @return HistoricalExchangeRate
     * @throws RequestException
     */
    public function historical(HistoricalExchangeRateRequest $request);

    /**
     * Get the time series exchange rate data
     *
     * @param  TimeSeriesExchangeRateRequest  $request
     * @return TimeSeriesExchangeRate
     * @throws RequestException
     */
    public function timeSeries(TimeSeriesExchangeRateRequest $request);
}
