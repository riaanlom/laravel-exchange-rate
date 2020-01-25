<?php

namespace Yoelpc4\LaravelExchangeRate\Services\Contracts;

use GuzzleHttp\Exception\GuzzleException;
use Yoelpc4\LaravelExchangeRate\Exceptions\HistoricalExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\LatestExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\TimeSeriesExchangeRateException;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\HistoricalExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\LatestExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\TimeSeriesExchangeRate;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\HistoricalRequest;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\LatestRequest;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\TimeSeriesRequest;

interface ExchangeRateService
{
    /**
     * Get the latest exchange rate data
     *
     * @param  LatestRequest  $request
     * @return LatestExchangeRate
     * @throws GuzzleException
     * @throws LatestExchangeRateException
     */
    public function latest(LatestRequest $request);

    /**
     * Get the historical exchange rate data
     *
     * @param  HistoricalRequest  $request
     * @return HistoricalExchangeRate
     * @throws GuzzleException
     * @throws HistoricalExchangeRateException
     */
    public function historical(HistoricalRequest $request);

    /**
     * Get the time series exchange rate data
     *
     * @param  TimeSeriesRequest  $request
     * @return TimeSeriesExchangeRate
     * @throws GuzzleException
     * @throws TimeSeriesExchangeRateException
     */
    public function timeSeries(TimeSeriesRequest $request);
}
