<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate;

interface LatestExchangeRateFactoryInterface
{
    /**
     * Create a new latest exchange rate request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @return LatestExchangeRateRequestInterface
     */
    public function makeRequest(string $base, $symbols);

    /**
     * Create a new latest exchange rate response instance.
     *
     * @param  LatestExchangeRateRequestInterface  $request
     * @param  string  $contents
     * @return SupportedCurrenciesResponseContract
     */
    public function makeResponse(LatestExchangeRateRequestInterface $request, string $contents);
}
