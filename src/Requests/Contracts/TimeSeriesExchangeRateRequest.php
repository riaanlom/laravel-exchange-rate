<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts;

interface TimeSeriesExchangeRateRequest extends Request
{
    /**
     * Get time series exchange rate handle's base
     *
     * @return string
     */
    public function base();

    /**
     * Get time series exchange rate handle's symbols
     *
     * @return array
     */
    public function symbols();

    /**
     * Get time series exchange rate handle's start date
     *
     * @return string
     */
    public function startDate();

    /**
     * Get time series exchange rate handle's end date
     *
     * @return string
     */
    public function endDate();
}
