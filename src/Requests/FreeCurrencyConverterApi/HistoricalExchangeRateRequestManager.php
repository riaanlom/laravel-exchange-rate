<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\Requests\HistoricalExchangeRateRequestFactory;

class HistoricalExchangeRateRequestManager implements HistoricalExchangeRateRequestFactory
{
    use Util;

    /**
     * @inheritDoc
     */
    public function make(string $base, $symbols, string $date)
    {
        $base = strtoupper($base);

        $symbols = $this->makeSymbols($symbols);

        return new HistoricalExchangeRateRequest($base, $symbols, $date);
    }
}
