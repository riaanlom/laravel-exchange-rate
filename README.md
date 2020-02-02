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

Publish package resources via command:

```bash
php artisan vendor:publish --provider="Yoelpc4\LaravelExchangeRate\Providers\ExchangeRateServiceProvider" --tag=resources
```

## Third Party Service Providers

Supported exchange rate service providers:
- [Free Currency Converter Api](https://free.currencyconverterapi.com/) (free_currency_converter_api)
 
To switching between different providers, define the default exchange rate provider value in your .env 
`EXCHANGE_RATE_PROVIDER=free_currency_converter_api`

After you've defined the default provider, you're ready to use this package's service. 

## Supported Currencies

Get the supported currencies data via syntax:

```php
try {
    $supportedCurrencies = \ExchangeRateService::supportedCurrencies();
} catch (\GuzzleHttp\Exception\RequestException $e) {
    throw $e;
}
```

The return value always instance of `\Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesResponseContract`.

## Latest Exchange Rate

Get the latest exchange rate data via syntax:

```php
try {
    $base = 'IDR';
    
    $symbols = [
        'USD', 'DZD',
    ];
    
    $latestExchangeRate = \ExchangeRateService::latest($base, $symbols);
} catch (\GuzzleHttp\Exception\RequestException $e) {
    throw $e;
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
}
```

The return value always instance of `\Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateResponseContract`.

## Historical Exchange Rate

Get the historical exchange rate data via syntax:

```php
try {
    $base = 'IDR';
    
    $symbols = [
        'USD', 'DZD',
    ];

    $date = now()->subDays(3)->toDateString();
    
    $historicalExchangeRate = \ExchangeRateService::latest($base, $symbols, $date);
} catch (\GuzzleHttp\Exception\RequestException $e) {
    throw $e;
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
}
```

The return value always instance of `\Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateResponseContract`.

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
    
    $timeSeriesExchangeRate = \ExchangeRateService::timeSeries($base, $symbols, $startDate, $endDate);
} catch (\GuzzleHttp\Exception\RequestException $e) {
    throw $e;
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
}
```

The return value always instance of `\Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateResponseContract`.

## Side Note

This package will run validation based on respective provider rules before dispatching some requests,
therefore it will throw `\Illuminate\Validation\ValidationException` for every unmet validation rules.

## License

The Laravel Exchange Rate is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

[ico-laravel]: https://img.shields.io/badge/Laravel-6.x-red.svg?style=flat-square
[ico-packagist]: https://img.shields.io/packagist/v/yoelpc4/laravel-exchange-rate.svg?style=flat-square
[ico-build]: https://travis-ci.com/yoelpc4/laravel-exchange-rate.svg?branch=master&style=flat-square
[ico-code-coverage]: https://codecov.io/gh/yoelpc4/laravel-exchange-rate/branch/master/graph/badge.svg?style=flat-square
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
