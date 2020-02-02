<?php

namespace Yoelpc4\LaravelExchangeRate\HistoricalExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Rate;
use Yoelpc4\LaravelExchangeRate\Utils\FreeCurrencyConverterApiUtil;

class HistoricalExchangeRateFactory implements HistoricalExchangeRateFactoryContract
{
    use FreeCurrencyConverterApiUtil;

    /**
     * @inheritDoc
     */
    public function makeRequest(string $base, $symbols, string $date)
    {
        $base = strtoupper($base);

        $symbols = $this->makeSymbols($symbols);

        return new HistoricalExchangeRateRequest($base, $symbols, $date);
    }

    /**
     * @inheritDoc
     */
    public function makeResponse(HistoricalExchangeRateRequestContract $request, string $contents)
    {
        $base = $request->base();

        $symbols = $request->symbols();

        $date = $request->date();

        $data = json_decode($contents, true);

        $rates = array_map(function (array $values, string $key) use ($date) {
            [$fromCurrency, $toCurrency] = explode('_', $key);

            return new Rate($fromCurrency, $toCurrency, $date, $values[$date]);
        }, $data, array_keys($data));

        return new HistoricalExchangeRateResponse($base, $symbols, $date, $rates);
    }
}
