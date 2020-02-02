<?php

namespace Yoelpc4\LaravelExchangeRate\Services\FreeCurrencyConverterApi;

use GuzzleHttp\Exception\RequestException;
use Yoelpc4\LaravelExchangeRate\Contracts\Apis\ApiContract;
use Yoelpc4\LaravelExchangeRate\Contracts\Apis\ApiFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\Service;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateRequestContract;

class FreeCurrencyConverterApiService implements Service
{
    /**
     * @var ApiContract
     */
    protected $api;

    /**
     * FreeCurrencyConverterApiService constructor.
     */
    public function __construct()
    {
        $this->api = \App::make(ApiFactoryContract::class)
            ->make(\Config::get('exchange-rate.providers.free_currency_converter_api.base_url'));
    }

    /**
     * @inheritDoc
     */
    public function supportedCurrencies(SupportedCurrenciesRequestContract $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(SupportedCurrenciesFactoryContract::class)
                ->makeResponse($response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function latest(LatestExchangeRateRequestContract $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(LatestExchangeRateFactoryContract::class)
                ->makeResponse($request, $response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function historical(HistoricalExchangeRateRequestContract $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(HistoricalExchangeRateFactoryContract::class)
                ->makeResponse($request, $response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function timeSeries(TimeSeriesExchangeRateRequestContract $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(TimeSeriesExchangeRateFactoryContract::class)
                ->makeResponse($request, $response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }
}
