# Laravel Exchange Rate

[![Packagist][ico-packagist]][link-packagist]
[![Downloads][ico-downloads]][link-packagist]
[![Build][ico-build]][link-build]
[![Code Coverage][ico-code-coverage]][link-code-coverage]
[![Software License][ico-license]](LICENSE.md)
[![Contributor Covenant][ico-code-of-conduct]](CODE_OF_CONDUCT.md)

_Laravel Exchange Rate helper._

## Requirement

- [Laravel](https://laravel.com)

## Install

Require this package with composer via command:

```bash
composer require yoelpc4/laravel-exchange-rate
```

## Package Publication

Publish package configuration via command:

```bash
php artisan vendor:publish --provider="Yoelpc4\LaravelExchangeRate\ExchangeRateServiceProvider" --tag=config
```

Publish package resources via command:

```bash
php artisan vendor:publish --provider="Yoelpc4\LaravelExchangeRate\ExchangeRateServiceProvider" --tag=resources
```

## Available Service Providers

Available exchange rate service providers:
- [Free Currency Converter Api](https://free.currencyconverterapi.com/)

## Supported Currencies

Get supported currencies

```php
try {
    $currencies = \ExchangeRateService::currencies();
} catch (\GuzzleHttp\Exception\RequestException $e) {
    throw $e;
}
```

The return value is an array of `\Yoelpc4\LaravelExchangeRate\Currency` object.

## Latest Exchange Rate

Get latest exchange rate

```php
try {
    $base = 'IDR';
    
    $symbols = [
        'USD', 'DZD',
    ];
    
    $latestExchangeRate = \ExchangeRateService::latest($base, $symbols);
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
} catch (\GuzzleHttp\Exception\RequestException $e) {
    throw $e;
}
```

The return value is an array of `\Yoelpc4\LaravelExchangeRate\ExchangeRate` object.

## Historical Exchange Rate

Get historical exchange rate

```php
try {
    $base = 'IDR';
    
    $symbols = [
        'USD', 'DZD',
    ];

    $date = now()->subDays(3)->toDateString();
    
    $historicalExchangeRate = \ExchangeRateService::latest($base, $symbols, $date);
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
} catch (\GuzzleHttp\Exception\RequestException $e) {
    throw $e;
}
```

The return value is an array of `\Yoelpc4\LaravelExchangeRate\ExchangeRate` object.

## Time Series Exchange Rate

Get time series exchange rate

```php
try {
    $base = 'IDR';
    
    $symbols = [
        'USD', 'DZD',
    ];
    
    $startDate = now()->subDays(8)->toDateString();

    $endDate = now()->toDateString();
    
    $timeSeriesExchangeRate = \ExchangeRateService::timeSeries($base, $symbols, $startDate, $endDate);
} catch (\Illuminate\Validation\ValidationException $e) {
    throw $e;
} catch (\GuzzleHttp\Exception\RequestException $e) {
    throw $e;
}
```

The return value is an array of `\Yoelpc4\LaravelExchangeRate\ExchangeRate` object.

## Switching Provider

You can switch between available providers

```php
try {
    $currencies = \ExchangeRateService::provider('free_currency_converter_api')->currencies();
} catch (\GuzzleHttp\Exception\RequestException $e) {
    throw $e;
}
```

## Caveat

This package will run validation based on respective provider rules before dispatching some requests,
therefore it will throw `\Illuminate\Validation\ValidationException` for every unmet validation rules.

## License

The Laravel Exchange Rate is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

[ico-packagist]: https://img.shields.io/packagist/v/yoelpc4/laravel-exchange-rate.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/yoelpc4/laravel-exchange-rate.svg?style=flat-square
[ico-build]: https://travis-ci.com/yoelpc4/laravel-exchange-rate.svg?branch=master&style=flat-square
[ico-code-coverage]: https://codecov.io/gh/yoelpc4/laravel-exchange-rate/branch/master/graph/badge.svg?style=flat-square
[ico-license]: https://img.shields.io/packagist/l/yoelpc4/laravel-exchange-rate.svg?style=flat-square
[ico-code-of-conduct]: https://img.shields.io/badge/Contributor%20Covenant-v2.0%20adopted-ff69b4.svg

[link-packagist]: https://packagist.org/packages/yoelpc4/laravel-exchange-rate
[link-build]: https://travis-ci.com/yoelpc4/laravel-exchange-rate
[link-code-coverage]: https://codecov.io/gh/yoelpc4/laravel-exchange-rate
