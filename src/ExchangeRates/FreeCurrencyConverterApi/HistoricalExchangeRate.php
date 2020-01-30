<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\HistoricalExchangeRate as HistoricalExchangeRateContract;
use Yoelpc4\LaravelExchangeRate\Rate;

class HistoricalExchangeRate extends ExchangeRate implements HistoricalExchangeRateContract
{
    /**
     * @var string
     */
    protected $date;

    /**
     * HistoricalExchangeRate constructor.
     *
     * @param  string  $base
     * @param  array  $symbols
     * @param  string  $date
     * @param  Rate[]  $rates
     */
    public function __construct(string $base, array $symbols, string $date, $rates)
    {
        $this->base = $base;

        $this->symbols = $symbols;

        $this->date = $date;

        $this->rates = $rates;
    }

    /**
     * @inheritDoc
     */
    public function date()
    {
        return $this->date;
    }
}
