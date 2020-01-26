<?php

namespace Yoelpc4\LaravelExchangeRate\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Yoelpc4\LaravelExchangeRate\Exceptions\ServiceException;
use Yoelpc4\LaravelExchangeRate\ExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\HistoricalExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\LatestExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\SupportedCurrenciesFactory;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\TimeSeriesExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\HistoricalExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\LatestExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\SupportedCurrenciesRequestFactory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\TimeSeriesExchangeRateRequestFactory;
use Yoelpc4\LaravelExchangeRate\Services\Contracts\ExchangeRateService;

class ExchangeRateServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $providers = [
        'free_currency_converter_api' => [
            ExchangeRateService::class                  => \Yoelpc4\LaravelExchangeRate\Services\FreeCurrencyConverterApi\Service::class,
            SupportedCurrenciesRequestFactory::class    => \Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Factories\SupportedCurrenciesRequestFactory::class,
            LatestExchangeRateRequestFactory::class     => \Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Factories\LatestExchangeRateRequestFactory::class,
            HistoricalExchangeRateRequestFactory::class => \Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Factories\HistoricalExchangeRateRequestFactory::class,
            TimeSeriesExchangeRateRequestFactory::class => \Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Factories\TimeSeriesExchangeRateRequestFactory::class,
            SupportedCurrenciesFactory::class           => \Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\Factories\SupportedCurrenciesFactory::class,
            LatestExchangeRateFactory::class            => \Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\Factories\LatestExchangeRateFactory::class,
            HistoricalExchangeRateFactory::class        => \Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\Factories\HistoricalExchangeRateFactory::class,
            TimeSeriesExchangeRateFactory::class        => \Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\Factories\TimeSeriesExchangeRateFactory::class,
        ],
    ];

    /**
     * Register services.
     *
     * @return void
     * @throws ServiceException
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/exchange-rate.php', 'exchange-rate');

        try {
            $this->registerBindings();
        } catch (ServiceException $e) {
            throw $e;
        }

        $this->app->singleton('yoelpc4.exchange_rate', function () {
            return new ExchangeRate;
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
     * Register third party exchange rate service provider map
     *
     * @throws ServiceException
     */
    protected function registerBindings()
    {
        $default = \Config::get('exchange-rate.default');

        if (! in_array($default, array_keys($this->providers))) {
            throw new ServiceException('Undefined exchange rate service.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        foreach ($this->providers[$default] as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
