<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate;

interface LatestExchangeRateFactoryContract
{
    /**
     * Create a new latest exchange rate request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @return LatestExchangeRateRequestContract
     */
    public function makeRequest(string $base, $symbols);

    /**
     * Create a new latest exchange rate response instance.
     *
     * @param  LatestExchangeRateRequestContract  $request
     * @param  string  $contents
     * @return SupportedCurrenciesResponseContract
     */
    public function makeResponse(LatestExchangeRateRequestContract $request, string $contents);
}
