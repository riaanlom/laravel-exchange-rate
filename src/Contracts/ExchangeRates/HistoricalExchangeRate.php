<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates;

interface HistoricalExchangeRate extends ExchangeRate
{
    /**
     * Get historical exchange rate's date
     *
     * @return string
     */
    public function date();
}
