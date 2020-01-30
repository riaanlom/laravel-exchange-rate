<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\LatestExchangeRateFactory as LatestExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\LatestExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Rate;

class LatestExchangeRateManager implements LatestExchangeRateFactoryContract
{
    /**
     * @inheritDoc
     */
    public function make(LatestExchangeRateRequest $request, string $contents)
    {
        $base = $request->base();

        $symbols = $request->symbols();

        $data = json_decode($contents, true);

        $rates = array_map(function (float $value, string $key) {
            [$fromCurrency, $toCurrency] = explode('_', $key);
            $date = now()->toDateString();

            return new Rate($fromCurrency, $toCurrency, $date, $value);
        }, $data, array_keys($data));

        return new LatestExchangeRate($base, $symbols, $rates);
    }
}
