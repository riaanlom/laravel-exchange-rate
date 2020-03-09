<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate;

use Yoelpc4\LaravelExchangeRate\Contracts\Base\BaseResponseInterface;

interface TimeSeriesExchangeRateResponseInterface extends BaseResponseInterface
{
    /**
     * Get time series exchange rate response's start date
     *
     * @return string
     */
    public function startDate();

    /**
     * Get time series exchange rate response's end date
     *
     * @return string
     */
    public function endDate();
}
