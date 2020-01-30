<?php

namespace Yoelpc4\LaravelExchangeRate;

class Rate
{
    /**
     * @var string
     */
    protected $baseCurrency;

    /**
     * @var string
     */
    protected $targetCurrency;

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
     * @param  string  $baseCurrency
     * @param  string  $targetCurrency
     * @param  float  $value
     * @param  string  $date
     */
    public function __construct(string $baseCurrency, string $targetCurrency, string $date, float $value)
    {
        $this->baseCurrency = $baseCurrency;
        $this->targetCurrency = $targetCurrency;
        $this->date = $date;
        $this->value = $value;
    }

    /**
     * Get rate's base currency
     *
     * @return string
     */
    public function baseCurrency()
    {
        return $this->baseCurrency;
    }

    /**
     * Get rate's target currency
     *
     * @return string
     */
    public function targetCurrency()
    {
        return $this->targetCurrency;
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
