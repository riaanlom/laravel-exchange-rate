# Laravel Exchange Rate

[![Laravel 6.x][ico-laravel]][link-laravel]
[![Packagist][ico-packagist]][link-packagist]
[![Build][ico-build]][link-build]
[![Code Coverage][ico-code-coverage]][link-code-coverage]
[![Downloads][ico-downloads]][link-downloads]
[![License][ico-license]][link-license]
[![Contributor Covenant][ico-code-of-conduct]][link-code-of-conduct]

_Laravel Exchange Rate helper._

## Requirement

- [Laravel 6.x](https://laravel.com)

## Install

Require this package with composer via command:

```bash
composer require yoelpc4/laravel-exchange-rate
```

## Package Publication

Publish package configuration via command:

```bash
php artisan vendor:publish --provider="Yoelpc4\LaravelExchangeRate\Providers\ExchangeRateServiceProvider" --tag=config
```

You can also publish package resources via command:

```bash
php artisan vendor:publish --provider="Yoelpc4\LaravelExchangeRate\Providers\ExchangeRateServiceProvider" --tag=resources
```

## Third Party Service Providers

Supported exchange rate service providers:
- [Free Currency Converter Api](https://free.currencyconverterapi.com/) (free_currency_converter_api)
 
To switching between different providers, define the default exchange rate provider value in your .env 
`EXCHANGE_RATE_PROVIDER=free_currency_converter_api`

After you've defined the default provider, you're ready to use this package's service. 

## Latest Exchange Rate

Get the latest exchange rate data via syntax:

```php
try {
    $base = 'IDR';
    
    $symbols = [
        'USD', 'DZD',
    ];
    
    $latestExchangeRate = \ExchangeRate::latest($base, $symbols);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    throw $e;
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
} catch (\Yoelpc4\LaravelExchangeRate\Exceptions\LatestExchangeRateException $e) {
    throw $e;
}
```

The return value always instance of `Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\LatestExchangeRate`.

## Historical Exchange Rate

Get the historical exchange rate data via syntax:

```php
try {
    $base = 'IDR';
    
    $symbols = [
        'USD', 'DZD',
    ];

    $date = now()->subDays(3)->toDateString();
    
    $historicalExchangeRate = \ExchangeRate::latest($base, $symbols, $date);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    throw $e;
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
} catch (\Yoelpc4\LaravelExchangeRate\Exceptions\HistoricalExchangeRateException $e) {
    throw $e;
}
```

The return value always instance of `Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\HistoricalExchangeRate`.

## Time Series Exchange Rate

Get the time series exchange rate data via syntax:

```php
try {
    $base = 'IDR';
    
    $symbols = [
        'USD', 'DZD',
    ];
    
    $startDate = now()->subDays(8)->toDateString();

    $endDate = now()->toDateString();
    
    $timeSeriesExchangeRate = \ExchangeRate::timeSeries($base, $symbols, $startDate, $endDate);
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    throw $e;
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
} catch (\Yoelpc4\LaravelExchangeRate\Exceptions\TimeSeriesExchangeRateException $e) {
    throw $e;
}
```

The return value always instance of `Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\TimeSeriesExchangeRate`.

## Side Note

This package will run validation based on respective provider rules before sending the request to the provider's server,
therefore it will throw `\Illuminate\Validation\ValidationException` for every unmet validation rules.

## License

The Laravel Exchange Rate is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

[ico-laravel]: https://img.shields.io/badge/Laravel-6.x-red.svg?style=flat-square
[ico-packagist]: https://img.shields.io/packagist/v/yoelpc4/laravel-exchange-rate.svg?style=flat-square
[ico-build]: https://img.shields.io/travis/com/yoelpc4/laravel-exchange-rate?style=flat-square
[ico-code-coverage]: https://img.shields.io/codecov/c/github/yoelpc4/laravel-exchange-rate?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/yoelpc4/laravel-exchange-rate.svg?style=flat-square
[ico-license]: https://img.shields.io/packagist/l/yoelpc4/laravel-exchange-rate.svg?style=flat-square
[ico-code-of-conduct]: https://img.shields.io/badge/Contributor%20Covenant-v1.4%20adopted-ff69b4.svg

[link-laravel]: https://laravel.com
[link-packagist]: https://packagist.org/packages/yoelpc4/laravel-exchange-rate
[link-build]: https://travis-ci.com/yoelpc4/laravel-exchange-rate
[link-code-coverage]: https://codecov.io/gh/yoelpc4/laravel-exchange-rate
[link-downloads]: https://packagist.org/packages/yoelpc4/laravel-exchange-rate
[link-license]: LICENSE.md
[link-code-of-conduct]: CODE_OF_CONDUCT.md
