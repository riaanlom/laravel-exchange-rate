<?php

namespace Yoelpc4\LaravelExchangeRate\HistoricalExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Base\FreeCurrencyConverterApi\BaseResponse;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRate\HistoricalExchangeRateResponseContract;
use Yoelpc4\LaravelExchangeRate\Rate;

class HistoricalExchangeRateResponse extends BaseResponse implements HistoricalExchangeRateResponseContract
{
    /**
     * @var string
     */
    protected $date;

    /**
     * HistoricalExchangeRateResponse constructor.
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
