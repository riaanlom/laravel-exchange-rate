<?php

namespace Yoelpc4\LaravelExchangeRate;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Contracts\MustValidated;
use Yoelpc4\LaravelExchangeRate\Contracts\ServiceInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesRequestInterface;
use Yoelpc4\LaravelExchangeRate\HistoricalExchangeRate\FreeCurrencyConverterApi\HistoricalExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\LatestExchangeRate\FreeCurrencyConverterApi\LatestExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\TimeSeriesExchangeRate\FreeCurrencyConverterApi\TimeSeriesExchangeRateFactory;

class ExchangeRateService
{
    /**
     * @var ServiceInterface
     */
    protected $service;

    /**
     * ExchangeRateService constructor.
     *
     * @param  ServiceInterface  $service
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Get the supported currencies data
     *
     * @return Contracts\SupportedCurrencies\SupportedCurrenciesResponseContract
     * @throws \GuzzleHttp\Exception\RequestException
     */
    public function supportedCurrencies()
    {
        $request = \App::make(SupportedCurrenciesRequestInterface::class);

        try {
            return $this->service->supportedCurrencies($request);
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * Get the latest exchange rate data
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @return Contracts\LatestExchangeRate\LatestExchangeRateResponseInterface
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function latest(string $base, $symbols)
    {
        $request = \App::make(LatestExchangeRateFactory::class)->makeRequest($base, $symbols);

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
     * @return Contracts\HistoricalExchangeRate\HistoricalExchangeRateResponseInterface
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function historical(string $base, $symbols, string $date)
    {
        $request = \App::make(HistoricalExchangeRateFactory::class)->makeRequest($base, $symbols, $date);

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
     * @return Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateResponseInterface
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function timeSeries(string $base, $symbols, string $startDate, string $endDate)
    {
        $request = \App::make(TimeSeriesExchangeRateFactory::class)->makeRequest($base, $symbols, $startDate, $endDate);

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
            \Validator::make($data, $rules, $messages, $customAttributes)->validate();
        } catch (ValidationException $e) {
            throw $e;
        }
    }
}
