<?php

namespace Yoelpc4\LaravelExchangeRate\Providers;

use Illuminate\Support\ServiceProvider;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\HistoricalExchangeRate;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\HistoricalExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\LatestExchangeRate;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\LatestExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\SupportedCurrencies;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\SupportedCurrenciesFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\TimeSeriesExchangeRate;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\TimeSeriesExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\HistoricalExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\HistoricalExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\LatestExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\LatestExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\SupportedCurrenciesRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\TimeSeriesExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\TimeSeriesExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\Services\Service;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\HistoricalExchangeRateManager;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\LatestExchangeRateManager;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\SupportedCurrenciesManager;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\TimeSeriesExchangeRateManager;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\HistoricalExchangeRateRequestManager;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\LatestExchangeRateRequestManager;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\TimeSeriesExchangeRateRequestManager;
use Yoelpc4\LaravelExchangeRate\Services\FreeCurrencyConverterApi\FreeCurrencyConverterApiService;

class FreeCurrencyConverterApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Service::class, FreeCurrencyConverterApiService::class);

        $this->app->bind(
            SupportedCurrenciesRequest::class,
            \Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\SupportedCurrenciesRequest::class
        );

        $this->app->bind(
            LatestExchangeRateRequestFactory::class,
            LatestExchangeRateRequestManager::class
        );

        $this->app->bind(
            LatestExchangeRateRequest::class,
            \Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\LatestExchangeRateRequest::class
        );

        $this->app->bind(
            HistoricalExchangeRateRequestFactory::class,
            HistoricalExchangeRateRequestManager::class
        );

        $this->app->bind(
            HistoricalExchangeRateRequest::class,
            \Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\HistoricalExchangeRateRequest::class
        );

        $this->app->bind(
            TimeSeriesExchangeRateRequestFactory::class,
            TimeSeriesExchangeRateRequestManager::class
        );

        $this->app->bind(
            TimeSeriesExchangeRateRequest::class,
            \Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\TimeSeriesExchangeRateRequest::class
        );

        $this->app->bind(
            SupportedCurrenciesFactory::class,
            SupportedCurrenciesManager::class
        );

        $this->app->bind(
            SupportedCurrencies::class,
            \Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\SupportedCurrencies::class
        );

        $this->app->bind(
            LatestExchangeRateFactory::class,
            LatestExchangeRateManager::class
        );

        $this->app->bind(
            LatestExchangeRate::class,
            \Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\LatestExchangeRate::class
        );

        $this->app->bind(
            HistoricalExchangeRateFactory::class,
            HistoricalExchangeRateManager::class
        );

        $this->app->bind(
            HistoricalExchangeRate::class,
            \Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\HistoricalExchangeRate::class
        );

        $this->app->bind(
            TimeSeriesExchangeRateFactory::class,
            TimeSeriesExchangeRateManager::class
        );

        $this->app->bind(
            TimeSeriesExchangeRate::class,
            \Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\TimeSeriesExchangeRateRequest::class
        );
    }
}
