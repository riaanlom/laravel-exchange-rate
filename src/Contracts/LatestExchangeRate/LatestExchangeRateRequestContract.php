<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate;

use Yoelpc4\LaravelExchangeRate\Contracts\Base\BaseRequestContract;

interface LatestExchangeRateRequestContract extends BaseRequestContract
{
    /**
     * Get latest exchange rate request's base
     *
     * @return string
     */
    public function base();

    /**
     * Get latest exchange rate request's symbols
     *
     * @return array
     */
    public function symbols();
}
