<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates;

interface SupportedCurrenciesFactory
{
    /**
     * Create a new supported currencies instance.
     *
     * @param  string  $contents
     * @return SupportedCurrencies
     */
    public function make(string $contents);
}
