<?php

namespace Yoelpc4\LaravelExchangeRate\Providers;

use Illuminate\Support\ServiceProvider;
use Yoelpc4\LaravelExchangeRate\Apis\GuzzleHttp\Api;
use Yoelpc4\LaravelExchangeRate\Apis\GuzzleHttp\ApiFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\Api\ApiInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\Api\ApiFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\ServiceInterface;
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

        $this->registerApi();

        $this->registerThirdPartyServiceProvider();

        $this->app->singleton('exchange_rate_service', function () {
            return new ExchangeRateService($this->app->make(ServiceInterface::class));
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

    /**
     * Register api bindings
     *
     * @return void
     */
    protected function registerApi()
    {
        $this->app->singleton(ApiFactoryInterface::class, ApiFactory::class);

        $this->app->singleton(ApiInterface::class, Api::class);
    }

    /**
     * Register selected third party service provider
     *
     * @return void
     */
    protected function registerThirdPartyServiceProvider()
    {
        $default = \Config::get('exchange-rate.default');

        $selectedServiceProvider = $this->serviceProviders[$default];

        $this->app->register($selectedServiceProvider);
    }
}
