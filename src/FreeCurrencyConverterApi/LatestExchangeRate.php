<?php

namespace Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRateInterface;

class LatestExchangeRate implements LatestExchangeRateInterface
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
     * @var ExchangeRate[]
     */
    protected $exchangeRates;

    /**
     * LatestExchangeRate constructor.
     *
     * @param  string  $base
     * @param  array  $targets
     * @param  array  $data
     */
    public function __construct(string $base, array $targets, array $data)
    {
        $this->base = $base;

        $this->targets = $targets;

        $date = now()->toDateString();

        $this->exchangeRates = collect($data)->map(function (float $value, string $index) use ($date) {
            [$baseCurrency, $targetCurrency] = explode('_', $index);

            return new ExchangeRate($baseCurrency, $targetCurrency, $date, $value);
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
    public function exchangeRates()
    {
        return $this->exchangeRates;
    }
}
