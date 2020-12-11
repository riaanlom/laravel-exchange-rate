<?php

namespace Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRateInterface;

class TimeSeriesExchangeRate implements TimeSeriesExchangeRateInterface
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
    protected $startDate;

    /**
     * @var string
     */
    protected $endDate;

    /**
     * @var ExchangeRate[]
     */
    protected $exchangeRates;

    /**
     * TimeSeriesExchangeRate constructor.
     *
     * @param  string  $base
     * @param  array  $targets
     * @param  string  $startDate
     * @param  string  $endDate
     * @param  array  $data
     */
    public function __construct(string $base, array $targets, string $startDate, string $endDate, array $data)
    {
        $this->base = $base;

        $this->targets = $targets;

        $this->startDate = $startDate;

        $this->endDate = $endDate;

        $this->exchangeRates = [];

        foreach ($data as $index => $values) {
            [$fromCurrency, $toCurrency] = explode('_', $index);

            foreach ($values as $date => $value) {
                $this->exchangeRates[] = new ExchangeRate($fromCurrency, $toCurrency, $date, $value);
            }
        }
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

    /**
     * @inheritDoc
     */
    public function exchangeRates()
    {
        return $this->exchangeRates;
    }
}
