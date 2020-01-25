<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\ExchangeRate as ExchangeRateContract;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Rate;

abstract class ExchangeRate implements ExchangeRateContract
{
    /**
     * @var string
     */
    protected $base;

    /**
     * @var array
     */
    protected $symbols;

    /**
     * @var Rate[]
     */
    protected $rates;

    /**
     * Get exchange rate's base
     *
     * @return string
     */
    public function base()
    {
        return $this->base;
    }

    /**
     * Get exchange rate's symbols
     *
     * @return array
     */
    public function symbols()
    {
        return $this->symbols;
    }

    /**
     * Get exchange rate's rates
     *
     * @return Rate[]
     */
    public function rates()
    {
        return $this->rates;
    }
}
