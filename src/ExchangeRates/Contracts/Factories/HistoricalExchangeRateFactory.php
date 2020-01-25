<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\HistoricalExchangeRate;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\HistoricalRequest;

interface HistoricalExchangeRateFactory
{
    /**
     * Create a new historical exchange rate instance.
     *
     * @param  HistoricalRequest  $request
     * @param  string  $contents
     * @return HistoricalExchangeRate
     */
    public function make(HistoricalRequest $request, string $contents);
}
