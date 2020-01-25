<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\Factories;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\TimeSeriesExchangeRateFactory as TimeSeriesExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\TimeSeriesExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Rate;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\TimeSeriesRequest;

class TimeSeriesExchangeRateFactory implements TimeSeriesExchangeRateFactoryContract
{
    /**
     * @inheritDoc
     */
    public function make(TimeSeriesRequest $request, string $contents)
    {
        $base = strtoupper($request->base());

        $symbols = array_map(function ($symbol) {
            return strtoupper($symbol);
        }, $request->symbols());

        $startDate = $request->startDate();

        $endDate = $request->endDate();

        $data = json_decode($contents, true);

        $rates = [];

        foreach ($data as $key => $values) {
            [$fromCurrency, $toCurrency] = explode('_', $key);

            foreach ($values as $date => $value) {
                $rates[] = new Rate($fromCurrency, $toCurrency, $date, $value);
            }
        }

        return new TimeSeriesExchangeRate($base, $symbols, $startDate, $endDate, $rates);
    }
}
