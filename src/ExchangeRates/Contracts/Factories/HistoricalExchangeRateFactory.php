<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\HistoricalExchangeRate;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\HistoricalExchangeRateRequest;

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
