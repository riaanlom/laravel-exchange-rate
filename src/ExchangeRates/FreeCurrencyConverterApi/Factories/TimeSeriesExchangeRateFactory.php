<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\Factories;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\TimeSeriesExchangeRateFactory as TimeSeriesExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\TimeSeriesExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Rate;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\TimeSeriesExchangeRateRequest;

class TimeSeriesExchangeRateFactory implements TimeSeriesExchangeRateFactoryContract
{
    /**
     * @inheritDoc
     */
    public function make(TimeSeriesExchangeRateRequest $request, string $contents)
    {
        $base = $request->base();

        $symbols = $request->symbols();

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
