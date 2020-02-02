<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate;

interface HistoricalExchangeRateFactoryContract
{
    /**
     * Create a new historical exchange rate request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $date
     * @return HistoricalExchangeRateRequestContract
     */
    public function makeRequest(string $base, $symbols, string $date);

    /**
     * Create a new historical exchange rate response instance.
     *
     * @param  HistoricalExchangeRateRequestContract  $request
     * @param  string  $contents
     * @return HistoricalExchangeRateResponseContract
     */
    public function makeResponse(HistoricalExchangeRateRequestContract $request, string $contents);
}
