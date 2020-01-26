<?php

namespace Yoelpc4\LaravelExchangeRate\Services\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Yoelpc4\LaravelExchangeRate\Exceptions\SupportedCurrenciesException;
use Yoelpc4\LaravelExchangeRate\Exceptions\HistoricalExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\LatestExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\TimeSeriesExchangeRateException;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\SupportedCurrencies;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\HistoricalExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\LatestExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\TimeSeriesExchangeRate;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\SupportedCurrenciesRequest;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\HistoricalExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\LatestExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\TimeSeriesExchangeRateRequest;

interface Service
{
    /**
     * Get the supported currencies data
     *
     * @param  SupportedCurrenciesRequest  $request
     * @return SupportedCurrencies
     * @throws GuzzleException
     * @throws SupportedCurrenciesException
     */
    public function supportedCurrencies(SupportedCurrenciesRequest $request);

    /**
     * Get the latest exchange rate data
     *
     * @param  LatestExchangeRateRequest  $request
     * @return LatestExchangeRate
     * @throws GuzzleException
     * @throws LatestExchangeRateException
     */
    public function latest(LatestExchangeRateRequest $request);

    /**
     * Get the historical exchange rate data
     *
     * @param  HistoricalExchangeRateRequest  $request
     * @return HistoricalExchangeRate
     * @throws GuzzleException
     * @throws HistoricalExchangeRateException
     */
    public function historical(HistoricalExchangeRateRequest $request);

    /**
     * Get the time series exchange rate data
     *
     * @param  TimeSeriesExchangeRateRequest  $request
     * @return TimeSeriesExchangeRate
     * @throws GuzzleException
     * @throws TimeSeriesExchangeRateException
     */
    public function timeSeries(TimeSeriesExchangeRateRequest $request);
}
