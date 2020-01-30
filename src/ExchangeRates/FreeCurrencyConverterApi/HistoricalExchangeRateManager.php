<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\HistoricalExchangeRateFactory as HistoricalExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\HistoricalExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Rate;

class HistoricalExchangeRateManager implements HistoricalExchangeRateFactoryContract
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
