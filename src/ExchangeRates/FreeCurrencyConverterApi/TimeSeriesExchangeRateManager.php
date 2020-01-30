<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\TimeSeriesExchangeRateFactory as TimeSeriesExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\TimeSeriesExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\Rate;

class TimeSeriesExchangeRateManager implements TimeSeriesExchangeRateFactoryContract
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
