<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates;

use Yoelpc4\LaravelExchangeRate\Rate;

interface ExchangeRate
{
    /**
     * Get exchange rate's base
     *
     * @return string
     */
    public function base();

    /**
     * Get exchange rate's symbols
     *
     * @return array
     */
    public function symbols();

    /**
     * Get exchange rate's rates
     *
     * @return Rate[]
     */
    public function rates();
}
