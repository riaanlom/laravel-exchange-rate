<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

interface ExchangeRateInterface
{
    /**
     * Get exchange rate's base currency
     *
     * @return string
     */
    public function baseCurrency();

    /**
     * Get exchange rate's target currency
     *
     * @return string
     */
    public function targetCurrency();

    /**
     * Get exchange rate's date
     *
     * @return string
     */
    public function date();

    /**
     * Get exchange rate's value
     *
     * @return float
     */
    public function value();
}
