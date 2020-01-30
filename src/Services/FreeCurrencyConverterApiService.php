<?php

namespace Yoelpc4\LaravelExchangeRate\Services\FreeCurrencyConverterApi;

use GuzzleHttp\Exception\RequestException;
use Yoelpc4\LaravelExchangeRate\Contracts\Apis\Api;
use Yoelpc4\LaravelExchangeRate\Contracts\Apis\Factory;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\HistoricalExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\LatestExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\SupportedCurrenciesFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\TimeSeriesExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\HistoricalExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\LatestExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\SupportedCurrenciesRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\TimeSeriesExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Services\Service;

class FreeCurrencyConverterApiService implements Service
{
    /**
     * @var Api
     */
    protected $api;

    /**
     * FreeCurrencyConverterApiService constructor.
     */
    public function __construct()
    {
        $this->api = \App::make(Factory::class)
            ->make(\Config::get('exchange-rate.providers.free_currency_converter_api.base_url'));
    }

    /**
     * @inheritDoc
     */
    public function supportedCurrencies(SupportedCurrenciesRequest $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(SupportedCurrenciesFactory::class)
                ->make($response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function latest(LatestExchangeRateRequest $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(LatestExchangeRateFactory::class)
                ->make($request, $response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function historical(HistoricalExchangeRateRequest $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(HistoricalExchangeRateFactory::class)
                ->make($request, $response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function timeSeries(TimeSeriesExchangeRateRequest $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(TimeSeriesExchangeRateFactory::class)
                ->make($request, $response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }
}
