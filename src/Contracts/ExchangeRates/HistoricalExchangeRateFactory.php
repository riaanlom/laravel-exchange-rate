<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates;


use Yoelpc4\LaravelExchangeRate\Contracts\Requests\HistoricalExchangeRateRequest;

interface HistoricalExchangeRateFactory
{
    /**
     * Create a new historical exchange rate instance.
     *
     * @param  HistoricalExchangeRateRequest  $request
     * @param  string  $contents
     * @return HistoricalExchangeRate
     */
    public function make(HistoricalExchangeRateRequest $request, string $contents);
}
