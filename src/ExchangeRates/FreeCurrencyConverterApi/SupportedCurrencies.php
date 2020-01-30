<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\SupportedCurrencies as SupportedCurrenciesContract;
use Yoelpc4\LaravelExchangeRate\Currency;

class SupportedCurrencies implements SupportedCurrenciesContract
{
    /**
     * @var Currency[]
     */
    protected $currencies;

    /**
     * SupportedCurrencies constructor.
     *
     * @param $currencies
     */
    public function __construct($currencies)
    {
        $this->currencies = $currencies;
    }

    /**
     * @inheritDoc
     */
    public function currencies()
    {
        return $this->currencies;
    }
}
