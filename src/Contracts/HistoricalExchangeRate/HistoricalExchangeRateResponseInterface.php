<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate;

use Yoelpc4\LaravelExchangeRate\Contracts\Base\BaseResponseInterface;

interface HistoricalExchangeRateResponseInterface extends BaseResponseInterface
{
    /**
     * Get historical exchange rate response's date
     *
     * @return string
     */
    public function date();
}
