<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

interface HistoricalExchangeRateInterface
{
    /**
     * Get historical exchange rate's base
     *
     * @return string
     */
    public function base();

    /**
     * Get historical exchange rate's targets
     *
     * @return array
     */
    public function targets();

    /**
     * Get historical exchange rate's date
     *
     * @return string
     */
    public function date();

    /**
     * Get historical exchange rate's exchange rates
     *
     * @return ExchangeRateInterface[]
     */
    public function exchangeRates();
}
