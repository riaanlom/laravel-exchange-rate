<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

interface Factory
{
    /**
     * Get exchange rate provider instance by name
     *
     * @param  string|null  $name
     * @return ExchangeRateProvider
     */
    public function provider(string $name = null);
}
