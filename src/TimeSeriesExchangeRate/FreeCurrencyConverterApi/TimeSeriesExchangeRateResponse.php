<?php

namespace Yoelpc4\LaravelExchangeRate\TimeSeriesExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Base\FreeCurrencyConverterApi\BaseResponse;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRate\TimeSeriesExchangeRateResponseInterface;
use Yoelpc4\LaravelExchangeRate\Rate;

class TimeSeriesExchangeRateResponse extends BaseResponse implements TimeSeriesExchangeRateResponseInterface
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
     * TimeSeriesExchangeRateResponse constructor.
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
