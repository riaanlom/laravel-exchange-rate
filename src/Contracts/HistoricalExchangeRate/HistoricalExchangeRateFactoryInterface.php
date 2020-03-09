<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate;

interface HistoricalExchangeRateFactoryInterface
{
    /**
     * Create a new historical exchange rate request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $date
     * @return HistoricalExchangeRateRequestInterface
     */
    public function makeRequest(string $base, $symbols, string $date);

    /**
     * Create a new historical exchange rate response instance.
     *
     * @param  HistoricalExchangeRateRequestInterface  $request
     * @param  string  $contents
     * @return HistoricalExchangeRateResponseInterface
     */
    public function makeResponse(HistoricalExchangeRateRequestInterface $request, string $contents);
}
