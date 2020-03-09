<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate;

use Yoelpc4\LaravelExchangeRate\Contracts\Base\BaseRequestInterface;

interface HistoricalExchangeRateRequestInterface extends BaseRequestInterface
{
    /**
     * Get historical exchange rate request's base
     *
     * @return string
     */
    public function base();

    /**
     * Get historical exchange rate request's symbols
     *
     * @return array
     */
    public function symbols();

    /**
     * Get historical exchange rate request's date
     *
     * @return string
     */
    public function date();
}
