<?php

namespace Yoelpc4\LaravelExchangeRate;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Exceptions\HistoricalExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\LatestExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\TimeSeriesExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\HistoricalRequestFactory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\LatestRequestFactory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\TimeSeriesRequestFactory;
use Yoelpc4\LaravelExchangeRate\Services\Contracts\ExchangeRateService;

class ExchangeRate
{
    /**
     * @var ExchangeRateService
     */
    protected $service;

    /**
     * ExchangeRate constructor.
     */
    public function __construct()
    {
        $this->service = \App::make(ExchangeRateService::class);
    }


    /**
     * Get the latest exchange rate data
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @return \Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\LatestExchangeRate
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yoelpc4\LaravelExchangeRate\Exceptions\LatestExchangeRateException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function latest(string $base, $symbols)
    {
        try {
            $request = \App::make(LatestRequestFactory::class)->make($base, $symbols);
        } catch (ValidationException $e) {
            throw $e;
        }

        try {
            return $this->service->latest($request);
        } catch (GuzzleException $e) {
            throw $e;
        } catch (LatestExchangeRateException $e) {
            throw $e;
        }
    }

    /**
     * Get the historical exchange rate data
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $date
     * @return \Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\HistoricalExchangeRate
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yoelpc4\LaravelExchangeRate\Exceptions\HistoricalExchangeRateException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function historical(string $base, $symbols, string $date)
    {
        try {
            $request = \App::make(HistoricalRequestFactory::class)->make($base, $symbols, $date);
        } catch (ValidationException $e) {
            throw $e;
        }

        try {
            return $this->service->historical($request);
        } catch (GuzzleException $e) {
            throw $e;
        } catch (HistoricalExchangeRateException $e) {
            throw $e;
        }
    }

    /**
     * Get the time series exchange rate data
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $startDate
     * @param  string  $endDate
     * @return \Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\TimeSeriesExchangeRate
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Yoelpc4\LaravelExchangeRate\Exceptions\TimeSeriesExchangeRateException
     */
    public function timeSeries(string $base, $symbols, string $startDate, string $endDate)
    {
        try {
            $request = \App::make(TimeSeriesRequestFactory::class)->make($base, $symbols, $startDate, $endDate);
        } catch (ValidationException $e) {
            throw $e;
        }

        try {
            return $this->service->timeSeries($request);
        } catch (GuzzleException $e) {
            throw $e;
        } catch (TimeSeriesExchangeRateException $e) {
            throw $e;
        }
    }
}
