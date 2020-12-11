<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

interface TimeSeriesExchangeRateInterface
{
    /**
     * Get time series exchange rate's base
     *
     * @return string
     */
    public function base();

    /**
     * Get time series exchange rate's targets
     *
     * @return array
     */
    public function targets();

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

    /**
     * Get time series exchange rate's exchange rates
     *
     * @return ExchangeRateInterface[]
     */
    public function exchangeRates();
}
