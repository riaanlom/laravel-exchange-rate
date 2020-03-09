<?php

namespace Yoelpc4\LaravelExchangeRate\TimeSeriesExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateRequestInterface;
use Yoelpc4\LaravelExchangeRate\Rate;
use Yoelpc4\LaravelExchangeRate\Utils\FreeCurrencyConverterApiUtil;

class TimeSeriesExchangeRateFactory implements TimeSeriesExchangeRateFactoryInterface
{
    use FreeCurrencyConverterApiUtil;

    /**
     * @inheritDoc
     */
    public function makeRequest(string $base, $symbols, string $startDate, string $endDate)
    {
        $base = strtoupper($base);

        $symbols = $this->makeSymbols($symbols);

        return new TimeSeriesExchangeRateRequest($base, $symbols, $startDate, $endDate);
    }

    /**
     * @inheritDoc
     */
    public function makeResponse(TimeSeriesExchangeRateRequestInterface $request, string $contents)
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

        return new TimeSeriesExchangeRateResponse($base, $symbols, $startDate, $endDate, $rates);
    }
}
