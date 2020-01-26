<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\SupportedCurrencies;

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
