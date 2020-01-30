<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates;

use Yoelpc4\LaravelExchangeRate\Currency;

interface SupportedCurrencies
{
    /**
     * Get supported currencies's currencies
     *
     * @return Currency[]
     */
    public function currencies();
}
