<?php

namespace Yoelpc4\LaravelExchangeRate;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Exceptions\HistoricalExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\LatestExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\SupportedCurrenciesException;
use Yoelpc4\LaravelExchangeRate\Exceptions\TimeSeriesExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\HistoricalExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\LatestExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\SupportedCurrenciesRequestFactory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\TimeSeriesExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\MustValidated;
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
     * Get the supported currencies data
     *
     * @return \Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\SupportedCurrencies
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yoelpc4\LaravelExchangeRate\Exceptions\SupportedCurrenciesException
     */
    public function supportedCurrencies()
    {
        $request = \App::make(SupportedCurrenciesRequestFactory::class)->make();

        try {
            return $this->service->supportedCurrencies($request);
        } catch (GuzzleException $e) {
            throw $e;
        } catch (SupportedCurrenciesException $e) {
            throw $e;
        }
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
        $request = \App::make(LatestExchangeRateRequestFactory::class)->make($base, $symbols);

        try {
            $this->validate($request);
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
        $request = \App::make(HistoricalExchangeRateRequestFactory::class)->make($base, $symbols, $date);

        try {
            $this->validate($request);
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
        $request = \App::make(TimeSeriesExchangeRateRequestFactory::class)->make($base, $symbols, $startDate, $endDate);

        try {
            $this->validate($request);
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

    /**
     * Validates the given request
     *
     * @param  MustValidated  $request
     * @throws ValidationException
     */
    protected function validate(MustValidated $request)
    {
        $data = $request->data();

        $rules = $request->rules();

        $messages = $request->messages();

        $customAttributes = $request->customAttributes();

        try {
            \App::make(Factory::class)->make($data, $rules, $messages, $customAttributes)->validate();
        } catch (ValidationException $e) {
            throw $e;
        }
    }
}
