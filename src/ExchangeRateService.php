<?php

namespace Yoelpc4\LaravelExchangeRate;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\HistoricalExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\LatestExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\MustValidated;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\SupportedCurrenciesRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\TimeSeriesExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\Services\Service;

class ExchangeRateService
{
    /**
     * @var Service
     */
    protected $service;

    /**
     * ExchangeRateService constructor.
     *
     * @param  Service  $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Get the supported currencies data
     *
     * @return \Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\SupportedCurrencies
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Yoelpc4\LaravelExchangeRate\Exceptions\SupportedCurrenciesException
     */
    public function supportedCurrencies()
    {
        $request = \App::make(SupportedCurrenciesRequest::class);

        try {
            return $this->service->supportedCurrencies($request);
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     *
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @return \Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\LatestExchangeRate
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function latest(string $base, $symbols)
    {
        $request = \App::make(LatestExchangeRateRequestFactory::class)
            ->make($base, $symbols);

        try {
            $this->validate($request);
        } catch (ValidationException $e) {
            throw $e;
        }

        try {
            return $this->service->latest($request);
        } catch (RequestException $e) {
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
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function historical(string $base, $symbols, string $date)
    {
        $request = \App::make(HistoricalExchangeRateRequestFactory::class)
            ->make($base, $symbols, $date);

        try {
            $this->validate($request);
        } catch (ValidationException $e) {
            throw $e;
        }

        try {
            return $this->service->historical($request);
        } catch (RequestException $e) {
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
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function timeSeries(string $base, $symbols, string $startDate, string $endDate)
    {
        $request = \App::make(TimeSeriesExchangeRateRequestFactory::class)
            ->make($base, $symbols, $startDate, $endDate);

        try {
            $this->validate($request);
        } catch (ValidationException $e) {
            throw $e;
        }

        try {
            return $this->service->timeSeries($request);
        } catch (RequestException $e) {
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
