<?php

namespace Yoelpc4\LaravelExchangeRate\tests;

use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Yoelpc4\LaravelExchangeRate\Facades\ExchangeRate;
use Yoelpc4\LaravelExchangeRate\Providers\ExchangeRateServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * @inheritDoc
     */
    protected function getPackageProviders($app)
    {
        return [
            ExchangeRateServiceProvider::class,
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getPackageAliases($app)
    {
        return [
            'ExchangeRate' => ExchangeRate::class,
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getEnvironmentSetUp($app)
    {
        $app->useEnvironmentPath(__DIR__.'/../..')
            ->loadEnvironmentFrom('.env.testing')
            ->bootstrapWith([
                LoadEnvironmentVariables::class,
            ]);

        $app['config']->set('exchange-rate.default', env('EXCHANGE_RATE_PROVIDER'));

        $app['config']->set('exchange-rate.providers.free_currency_converter_api', [
            'api_key'  => env('FREE_CURRENCY_CONVERTER_API_KEY'),
            'base_url' => env('FREE_CURRENCY_CONVERTER_API_BASE_URL'),
        ]);
    }
}
