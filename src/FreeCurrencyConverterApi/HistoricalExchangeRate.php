<?php

namespace Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRateInterface;

class HistoricalExchangeRate implements HistoricalExchangeRateInterface
{
    /**
     * @var string
     */
    protected $base;

    /**
     * @var array
     */
    protected $targets;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var ExchangeRate[]
     */
    protected $exchangeRates;

    /**
     * HistoricalExchangeRate constructor.
     *
     * @param  string  $base
     * @param  array  $targets
     * @param  string  $date
     * @param  array  $data
     */
    public function __construct(string $base, array $targets, string $date, array $data)
    {
        $this->base = $base;

        $this->targets = $targets;

        $this->date = $date;

        $this->exchangeRates = collect($data)->map(function (array $values, string $index) use ($date) {
            [$baseCurrency, $targetCurrency] = explode('_', $index);

            return new ExchangeRate($baseCurrency, $targetCurrency, $date, $values[$date]);
        })->all();
    }

    /**
     * @inheritDoc
     */
    public function base()
    {
        return $this->base;
    }

    /**
     * @inheritDoc
     */
    public function targets()
    {
        return $this->targets;
    }

    /**
     * @inheritDoc
     */
    public function date()
    {
        return $this->date;
    }

    /**
     * @inheritDoc
     */
    public function exchangeRates()
    {
        return $this->exchangeRates;
    }
}
