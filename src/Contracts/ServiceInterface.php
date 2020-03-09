<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

use GuzzleHttp\Exception\RequestException;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateRequestInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateResponseInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateRequestInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateResponseInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesRequestInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesResponseContract;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateRequestInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateResponseInterface;

interface ServiceInterface
{
    /**
     * Get the supported currencies data
     *
     * @param  SupportedCurrenciesRequestInterface  $request
     * @return SupportedCurrenciesResponseContract
     * @throws RequestException
     */
    public function supportedCurrencies(SupportedCurrenciesRequestInterface $request);

    /**
     * Get the latest exchange rate data
     *
     * @param  LatestExchangeRateRequestInterface  $request
     * @return LatestExchangeRateResponseInterface
     * @throws RequestException
     */
    public function latest(LatestExchangeRateRequestInterface $request);

    /**
     * Get the historical exchange rate data
     *
     * @param  HistoricalExchangeRateRequestInterface  $request
     * @return HistoricalExchangeRateResponseInterface
     * @throws RequestException
     */
    public function historical(HistoricalExchangeRateRequestInterface $request);

    /**
     * Get the time series exchange rate data
     *
     * @param  TimeSeriesExchangeRateRequestInterface  $request
     * @return TimeSeriesExchangeRateResponseInterface
     * @throws RequestException
     */
    public function timeSeries(TimeSeriesExchangeRateRequestInterface $request);
}
