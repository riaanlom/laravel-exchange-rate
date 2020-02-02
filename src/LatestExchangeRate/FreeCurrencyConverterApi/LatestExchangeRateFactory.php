<?php

namespace Yoelpc4\LaravelExchangeRate\LatestExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateFactoryContract;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Rate;
use Yoelpc4\LaravelExchangeRate\Utils\FreeCurrencyConverterApiUtil;

class LatestExchangeRateFactory implements LatestExchangeRateFactoryContract
{
    use FreeCurrencyConverterApiUtil;

    /**
     * @inheritDoc
     */
    public function makeRequest(string $base, $symbols)
    {
        $base = strtoupper($base);

        $symbols = $this->makeSymbols($symbols);

        return new LatestExchangeRateRequest($base, $symbols);
    }

    /**
     * @inheritDoc
     */
    public function makeResponse(LatestExchangeRateRequestContract $request, string $contents)
    {
        $base = $request->base();

        $symbols = $request->symbols();

        $data = json_decode($contents, true);

        $rates = array_map(function (float $value, string $key) {
            [$fromCurrency, $toCurrency] = explode('_', $key);
            $date = now()->toDateString();

            return new Rate($fromCurrency, $toCurrency, $date, $value);
        }, $data, array_keys($data));

        return new LatestExchangeRateResponse($base, $symbols, $rates);
    }
}
