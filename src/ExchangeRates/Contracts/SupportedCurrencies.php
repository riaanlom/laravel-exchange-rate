<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Currency;

interface SupportedCurrencies
{
    /**
     * Get supported currencies's currencies
     *
     * @return Currency[]
     */
    public function currencies();
}
