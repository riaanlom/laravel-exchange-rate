<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\TimeSeriesExchangeRate as TimeSeriesExchangeRateContract;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Rate;

class TimeSeriesExchangeRate extends ExchangeRate implements TimeSeriesExchangeRateContract
{
    /**
     * @var string
     */
    protected $startDate;

    /**
     * @var string
     */
    protected $endDate;

    /**
     * TimeSeriesExchangeRate constructor.
     *
     * @param  string  $base
     * @param  array  $symbols
     * @param  string  $startDate
     * @param  string  $endDate
     * @param  Rate[]  $rates
     */
    public function __construct(string $base, array $symbols, string $startDate, string $endDate, $rates)
    {
        $this->base = $base;

        $this->symbols = $symbols;

        $this->startDate = $startDate;

        $this->endDate = $endDate;

        $this->rates = $rates;
    }

    /**
     * @inheritDoc
     */
    public function startDate()
    {
        return $this->startDate;
    }

    /**
     * @inheritDoc
     */
    public function endDate()
    {
        return $this->endDate;
    }
}
