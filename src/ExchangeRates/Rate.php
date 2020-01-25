<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates;

class Rate
{
    /**
     * @var string
     */
    protected $fromCurrency;

    /**
     * @var string
     */
    protected $toCurrency;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var float
     */
    protected $value;

    /**
     * Rate constructor.
     *
     * @param  string  $fromCurrency
     * @param  string  $toCurrency
     * @param  float  $value
     * @param  string  $date
     */
    public function __construct(string $fromCurrency, string $toCurrency, string $date, float $value)
    {
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;
        $this->date = $date;
        $this->value = $value;
    }

    /**
     * Get rate's from currency
     *
     * @return string
     */
    public function fromCurrency()
    {
        return $this->fromCurrency;
    }

    /**
     * Get rate's to currency
     *
     * @return string
     */
    public function toCurrency()
    {
        return $this->toCurrency;
    }

    /**
     * Get rate's date
     *
     * @return string
     */
    public function date()
    {
        return $this->date;
    }

    /**
     * Get rate value
     *
     * @return float
     */
    public function value()
    {
        return $this->value;
    }
}
