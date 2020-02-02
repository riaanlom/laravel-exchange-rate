<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate;

use Yoelpc4\LaravelExchangeRate\Contracts\Base\BaseRequestContract;

interface TimeSeriesExchangeRateRequestContract extends BaseRequestContract
{
    /**
     * Get time series exchange rate request's base
     *
     * @return string
     */
    public function base();

    /**
     * Get time series exchange rate request's symbols
     *
     * @return array
     */
    public function symbols();

    /**
     * Get time series exchange rate request's start date
     *
     * @return string
     */
    public function startDate();

    /**
     * Get time series exchange rate request's end date
     *
     * @return string
     */
    public function endDate();
}
