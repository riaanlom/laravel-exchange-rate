<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Rate;

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
