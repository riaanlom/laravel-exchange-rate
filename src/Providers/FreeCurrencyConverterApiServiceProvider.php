<?php

namespace Yoelpc4\LaravelExchangeRate\Providers;

use Illuminate\Support\ServiceProvider;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateResponseContract;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateResponseContract;
use Yoelpc4\LaravelExchangeRate\Contracts\Service;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesResponseContract;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateResponseContract;
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
        $this->app->singleton(Service::class, FreeCurrencyConverterApiService::class);

        // supported currencies
        $this->app->bind(SupportedCurrenciesFactoryContract::class, SupportedCurrenciesFactory::class);
        $this->app->bind(SupportedCurrenciesRequestContract::class, SupportedCurrenciesRequest::class);
        $this->app->bind(SupportedCurrenciesResponseContract::class, SupportedCurrenciesResponse::class);

        // latest exchange rate
        $this->app->bind(LatestExchangeRateFactoryContract::class, LatestExchangeRateFactory::class);
        $this->app->bind(LatestExchangeRateRequestContract::class, LatestExchangeRateRequest::class);
        $this->app->bind(LatestExchangeRateResponseContract::class, LatestExchangeRateResponse::class);

        // historical exchange rate
        $this->app->bind(HistoricalExchangeRateFactoryContract::class, HistoricalExchangeRateFactory::class);
        $this->app->bind(HistoricalExchangeRateRequestContract::class, HistoricalExchangeRateRequest::class);
        $this->app->bind(HistoricalExchangeRateResponseContract::class, HistoricalExchangeRateResponse::class);

        // time series exchange rate
        $this->app->bind(TimeSeriesExchangeRateFactoryContract::class, TimeSeriesExchangeRateFactory::class);
        $this->app->bind(TimeSeriesExchangeRateRequestContract::class, TimeSeriesExchangeRateRequest::class);
        $this->app->bind(TimeSeriesExchangeRateResponseContract::class, TimeSeriesExchangeRateResponse::class);
    }
}
