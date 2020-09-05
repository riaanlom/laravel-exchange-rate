<?php

namespace Yoelpc4\LaravelExchangeRate;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Yoelpc4\LaravelExchangeRate\Api\ApiManager;
use Yoelpc4\LaravelExchangeRate\Contracts\Api\Factory;

class ExchangeRateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/exchange-rate.php', 'exchange-rate');

        $this->app->singleton(Factory::class, ApiManager::class);

        $this->app->singleton('exchange_rate_service', function (Application $app) {
            return new ExchangeRateServiceManager($app);
        });

        $this->app->singleton('exchange_rate_service.provider', function (Application $app) {
            return $app['exchange_rate_service']->provider();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'laravel-exchange-rate');

        $this->publishes([
            __DIR__.'/config/exchange-rate.php' => config_path('exchange-rate.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/laravel-exchange-rate'),
        ], 'resources');
    }
}
