<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\Factories;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\LatestExchangeRateFactory as LatestExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\LatestExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Rate;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\LatestRequest;

class LatestExchangeRateFactory implements LatestExchangeRateFactoryContract
{
    /**
     * @inheritDoc
     */
    public function make(LatestRequest $request, string $contents)
    {
        $base = strtoupper($request->base());

        $symbols = array_map(function ($symbol) {
            return strtoupper($symbol);
        }, $request->symbols());

        $data = json_decode($contents, true);

        $rates = array_map(function (float $value, string $key) {
            [$fromCurrency, $toCurrency] = explode('_', $key);
            $date = now()->toDateString();

            return new Rate($fromCurrency, $toCurrency, $date, $value);
        }, $data, array_keys($data));

        return new LatestExchangeRate($base, $symbols, $rates);
    }
}
