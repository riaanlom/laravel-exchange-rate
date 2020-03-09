<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies;

interface SupportedCurrenciesFactoryInterface
{
    /**
     * Create a new supported currencies response instance.
     *
     * @param  string  $contents
     * @return SupportedCurrenciesResponseContract
     */
    public function makeResponse(string $contents);
}
