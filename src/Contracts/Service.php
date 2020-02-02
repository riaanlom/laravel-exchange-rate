<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

use GuzzleHttp\Exception\RequestException;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateResponseContract;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateResponseContract;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesResponseContract;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateResponseContract;

interface Service
{
    /**
     * Get the supported currencies data
     *
     * @param  SupportedCurrenciesRequestContract  $request
     * @return SupportedCurrenciesResponseContract
     * @throws RequestException
     */
    public function supportedCurrencies(SupportedCurrenciesRequestContract $request);

    /**
     * Get the latest exchange rate data
     *
     * @param  LatestExchangeRateRequestContract  $request
     * @return LatestExchangeRateResponseContract
     * @throws RequestException
     */
    public function latest(LatestExchangeRateRequestContract $request);

    /**
     * Get the historical exchange rate data
     *
     * @param  HistoricalExchangeRateRequestContract  $request
     * @return HistoricalExchangeRateResponseContract
     * @throws RequestException
     */
    public function historical(HistoricalExchangeRateRequestContract $request);

    /**
     * Get the time series exchange rate data
     *
     * @param  TimeSeriesExchangeRateRequestContract  $request
     * @return TimeSeriesExchangeRateResponseContract
     * @throws RequestException
     */
    public function timeSeries(TimeSeriesExchangeRateRequestContract $request);
}
