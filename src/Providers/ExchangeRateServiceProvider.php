<?php

namespace Yoelpc4\LaravelExchangeRate\Providers;

use Illuminate\Support\ServiceProvider;
use Yoelpc4\LaravelExchangeRate\Apis\Guzzle\ApiManager;
use Yoelpc4\LaravelExchangeRate\Contracts\Apis\Api;
use Yoelpc4\LaravelExchangeRate\Contracts\Apis\Factory;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\SupportedCurrenciesRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\Services\Service;
use Yoelpc4\LaravelExchangeRate\ExchangeRateService;

class ExchangeRateServiceProvider extends ServiceProvider
{
    /**
     * Available exchange rate service providers
     *
     * @var array
     */
    protected $serviceProviders = [
        'free_currency_converter_api' => FreeCurrencyConverterApiServiceProvider::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/exchange-rate.php', 'exchange-rate');

        $this->app->singleton(Factory::class, ApiManager::class);
        $this->app->singleton(Api::class, \Yoelpc4\LaravelExchangeRate\Apis\Api::class);

        $this->app->register($this->serviceProviders[\Config::get('exchange-rate.default')]);

        $this->app->singleton('exchange_rate_service', function () {
            return new ExchangeRateService($this->app->make(Service::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-exchange-rate');

        $this->publishes([
            __DIR__.'/../config/exchange-rate.php' => config_path('exchange-rate.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-exchange-rate'),
        ], 'resources');
    }
}
