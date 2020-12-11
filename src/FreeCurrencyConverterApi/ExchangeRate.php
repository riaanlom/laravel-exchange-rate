<?php

namespace Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRateInterface;

class ExchangeRate implements ExchangeRateInterface
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
     * ExchangeRate constructor.
     *
     * @param  string  $baseCurrency
     * @param  string  $targetCurrency
     * @param  string  $date
     * @param  float  $value
     */
    public function __construct(string $baseCurrency, string $targetCurrency, string $date, float $value)
    {
        $this->baseCurrency = $baseCurrency;

        $this->targetCurrency = $targetCurrency;

        $this->date = $date;

        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function baseCurrency()
    {
        return $this->baseCurrency;
    }

    /**
     * @inheritDoc
     */
    public function targetCurrency()
    {
        return $this->targetCurrency;
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
    public function value()
    {
        return $this->value;
    }
}
