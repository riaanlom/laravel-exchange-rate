<?php

namespace Yoelpc4\LaravelExchangeRate\Services\FreeCurrencyConverterApi;

use GuzzleHttp\Exception\RequestException;
use Yoelpc4\LaravelExchangeRate\Contracts\Api\ApiInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\Api\ApiFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateRequestInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateRequestInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\ServiceInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesRequestInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateRequestInterface;

class FreeCurrencyConverterApiService implements ServiceInterface
{
    /**
     * @var ApiInterface
     */
    protected $api;

    /**
     * FreeCurrencyConverterApiService constructor.
     */
    public function __construct()
    {
        $this->api = \App::make(ApiFactoryInterface::class)
            ->make(\Config::get('exchange-rate.providers.free_currency_converter_api.base_url'));
    }

    /**
     * @inheritDoc
     */
    public function supportedCurrencies(SupportedCurrenciesRequestInterface $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(SupportedCurrenciesFactoryInterface::class)
                ->makeResponse($response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function latest(LatestExchangeRateRequestInterface $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(LatestExchangeRateFactoryInterface::class)
                ->makeResponse($request, $response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function historical(HistoricalExchangeRateRequestInterface $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(HistoricalExchangeRateFactoryInterface::class)
                ->makeResponse($request, $response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function timeSeries(TimeSeriesExchangeRateRequestInterface $request)
    {
        try {
            $response = $this->api->handle($request);

            return \App::make(TimeSeriesExchangeRateFactoryInterface::class)
                ->makeResponse($request, $response->getBody()->getContents());
        } catch (RequestException $e) {
            throw $e;
        }
    }
}
