<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies;

use Yoelpc4\LaravelExchangeRate\Currency;

interface SupportedCurrenciesResponseContract
{
    /**
     * Get supported currencies response's currencies
     *
     * @return Currency[]
     */
    public function currencies();
}
