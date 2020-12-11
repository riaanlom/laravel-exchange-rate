<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

interface LatestExchangeRateInterface
{
    /**
     * Get latest exchange rate's base
     *
     * @return string
     */
    public function base();

    /**
     * Get latest exchange rate's targets
     *
     * @return array
     */
    public function targets();

    /**
     * Get latest exchange rate's exchange rates
     *
     * @return ExchangeRateInterface[]
     */
    public function exchangeRates();
}
