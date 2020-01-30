<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\Requests\LatestExchangeRateRequestFactory;

class LatestExchangeRateRequestManager implements LatestExchangeRateRequestFactory
{
    use Util;

    /**
     * @inheritDoc
     */
    public function make(string $base, $symbols)
    {
        $base = strtoupper($base);

        $symbols = $this->makeSymbols($symbols);

        return new LatestExchangeRateRequest($base, $symbols);
    }
}
