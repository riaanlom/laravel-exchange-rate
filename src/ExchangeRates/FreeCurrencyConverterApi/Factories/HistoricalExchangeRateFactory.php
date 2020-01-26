<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\Factories;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\HistoricalExchangeRateFactory as HistoricalExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\HistoricalExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Rate;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\HistoricalExchangeRateRequest;

class HistoricalExchangeRateFactory implements HistoricalExchangeRateFactoryContract
{
    /**
     * @inheritDoc
     */
    public function make(HistoricalExchangeRateRequest $request, string $contents)
    {
        $base = $request->base();

        $symbols = $request->symbols();

        $date = $request->date();

        $data = json_decode($contents, true);

        $rates = array_map(function (array $values, string $key) use ($date) {
            [$fromCurrency, $toCurrency] = explode('_', $key);

            return new Rate($fromCurrency, $toCurrency, $date, $values[$date]);
        }, $data, array_keys($data));

        return new HistoricalExchangeRate($base, $symbols, $date, $rates);
    }
}
