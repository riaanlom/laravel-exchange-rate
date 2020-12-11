<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

interface SupportedCurrenciesInterface
{
    /**
     * Get supported currencies' currencies
     *
     * @return CurrencyInterface[]
     */
    public function currencies();
}
