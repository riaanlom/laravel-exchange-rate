<?php

namespace Yoelpc4\LaravelExchangeRate\Providers;

use Illuminate\Support\ServiceProvider;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateRequestInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateResponseInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateRequestInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateResponseInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\ServiceInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesRequestInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesResponseContract;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateRequestInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateResponseInterface;
use Yoelpc4\LaravelExchangeRate\HistoricalExchangeRate\FreeCurrencyConverterApi\HistoricalExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\HistoricalExchangeRate\FreeCurrencyConverterApi\HistoricalExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\HistoricalExchangeRate\FreeCurrencyConverterApi\HistoricalExchangeRateResponse;
use Yoelpc4\LaravelExchangeRate\LatestExchangeRate\FreeCurrencyConverterApi\LatestExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\LatestExchangeRate\FreeCurrencyConverterApi\LatestExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\LatestExchangeRate\FreeCurrencyConverterApi\LatestExchangeRateResponse;
use Yoelpc4\LaravelExchangeRate\Services\FreeCurrencyConverterApi\FreeCurrencyConverterApiService;
use Yoelpc4\LaravelExchangeRate\SupportedCurrencies\FreeCurrencyConverterApi\SupportedCurrenciesFactory;
use Yoelpc4\LaravelExchangeRate\SupportedCurrencies\FreeCurrencyConverterApi\SupportedCurrenciesRequest;
use Yoelpc4\LaravelExchangeRate\SupportedCurrencies\FreeCurrencyConverterApi\SupportedCurrenciesResponse;
use Yoelpc4\LaravelExchangeRate\TimeSeriesExchangeRate\FreeCurrencyConverterApi\TimeSeriesExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\TimeSeriesExchangeRate\FreeCurrencyConverterApi\TimeSeriesExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\TimeSeriesExchangeRate\FreeCurrencyConverterApi\TimeSeriesExchangeRateResponse;

class FreeCurrencyConverterApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // service
        $this->app->singleton(ServiceInterface::class, FreeCurrencyConverterApiService::class);

        // supported currencies
        $this->app->bind(SupportedCurrenciesFactoryInterface::class, SupportedCurrenciesFactory::class);
        $this->app->bind(SupportedCurrenciesRequestInterface::class, SupportedCurrenciesRequest::class);
        $this->app->bind(SupportedCurrenciesResponseContract::class, SupportedCurrenciesResponse::class);

        // latest exchange rate
        $this->app->bind(LatestExchangeRateFactoryInterface::class, LatestExchangeRateFactory::class);
        $this->app->bind(LatestExchangeRateRequestInterface::class, LatestExchangeRateRequest::class);
        $this->app->bind(LatestExchangeRateResponseInterface::class, LatestExchangeRateResponse::class);

        // historical exchange rate
        $this->app->bind(HistoricalExchangeRateFactoryInterface::class, HistoricalExchangeRateFactory::class);
        $this->app->bind(HistoricalExchangeRateRequestInterface::class, HistoricalExchangeRateRequest::class);
        $this->app->bind(HistoricalExchangeRateResponseInterface::class, HistoricalExchangeRateResponse::class);

        // time series exchange rate
        $this->app->bind(TimeSeriesExchangeRateFactoryInterface::class, TimeSeriesExchangeRateFactory::class);
        $this->app->bind(TimeSeriesExchangeRateRequestInterface::class, TimeSeriesExchangeRateRequest::class);
        $this->app->bind(TimeSeriesExchangeRateResponseInterface::class, TimeSeriesExchangeRateResponse::class);
    }
}
