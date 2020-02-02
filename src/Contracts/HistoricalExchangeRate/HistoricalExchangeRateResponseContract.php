<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate;

use Yoelpc4\LaravelExchangeRate\Contracts\Base\BaseResponseContract;

interface HistoricalExchangeRateResponseContract extends BaseResponseContract
{
    /**
     * Get historical exchange rate response's date
     *
     * @return string
     */
    public function date();
}
