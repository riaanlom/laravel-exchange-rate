<?php

namespace Yoelpc4\LaravelExchangeRate;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use InvalidArgumentException;
use Yoelpc4\LaravelExchangeRate\Contracts\Api\Api;
use Yoelpc4\LaravelExchangeRate\Contracts\Api\Factory as ApiFactory;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRateProvider;
use Yoelpc4\LaravelExchangeRate\Contracts\Factory;

/**
 * @mixin \Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRateProvider
 */
class ExchangeRateServiceManager implements Factory
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var array
     */
    protected $exchangeRateProviders = [];

    /**
     * ExchangeRateServiceManager constructor.
     *
     * @param  Application  $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get exchange rate provider instance by name
     *
     * @param  string|null  $name
     * @return \Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRateProvider
     */
    public function provider(string $name = null)
    {
        $name = $name ?: $this->getDefaultName();

        return $this->exchangeRateProviders[$name] = $this->get($name);
    }

    /**
     * Attempt to get the exchange rate provider from local cache
     *
     * @param  string  $name
     * @return ExchangeRateProvider
     */
    protected function get(string $name)
    {
        return $this->exchangeRateProviders[$name] ?? $this->resolve($name);
    }

    /**
     * Resolve the given provider
     *
     * @param  string  $name
     * @return ExchangeRateProvider
     */
    protected function resolve(string $name)
    {
        $config = $this->getConfig($name);

        if (is_null($config)) {
            throw new InvalidArgumentException("Exchange rate provider {$name} is not defined");
        }

        $exchangeRateProviderMethod = 'create'.ucfirst(\Str::camel($config['provider'])).'Provider';

        if (method_exists($this, $exchangeRateProviderMethod)) {
            return $this->$exchangeRateProviderMethod($config);
        } else {
            throw new InvalidArgumentException("Exchange rate provider {$config['provider']} is not supported");
        }
    }

    /**
     * Create an instance of free currency converter api provider
     *
     * @param  array  $config
     * @return FreeCurrencyConverterApiProvider
     * @throws BindingResolutionException
     */
    protected function createFreeCurrencyConverterApiProvider(array $config)
    {
        try {
            $api = $this->resolveApi($config['base_url']);
        } catch (BindingResolutionException $e) {
            throw $e;
        }

        return new FreeCurrencyConverterApiProvider($api, $config['api_key']);
    }

    /**
     * Resolve a new Api instance
     *
     * @param  string  $baseUrl
     * @return Api
     * @throws BindingResolutionException
     */
    protected function resolveApi(string $baseUrl)
    {
        try {
            return app(ApiFactory::class)->make($baseUrl);
        } catch (BindingResolutionException $e) {
            throw $e;
        }
    }

    /**
     * Get default exchange rate provider name
     *
     * @return string
     */
    protected function getDefaultName()
    {
        return $this->app['config']['exchange-rate.default'];
    }

    /**
     * Get the exchange rate provider configuration
     *
     * @param  string  $name
     * @return array
     */
    protected function getConfig(string $name)
    {
        return $this->app['config']["exchange-rate.providers.{$name}"];
    }

    /**
     * Dynamically call the default provider method
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->provider()->$method(...$parameters);
    }
}
