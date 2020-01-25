<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts;

interface HistoricalExchangeRate extends ExchangeRate
{
    /**
     * Get historical exchange rate's date
     *
     * @return string
     */
    public function date();
}
