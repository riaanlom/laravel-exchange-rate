<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts;

interface TimeSeriesExchangeRate extends ExchangeRate
{
    /**
     * Get time series exchange rate's start date
     *
     * @return string
     */
    public function startDate();

    /**
     * Get time series exchange rate's end date
     *
     * @return string
     */
    public function endDate();
}
