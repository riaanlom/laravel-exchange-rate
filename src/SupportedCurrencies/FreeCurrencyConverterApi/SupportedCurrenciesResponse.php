<?php

namespace Yoelpc4\LaravelExchangeRate\SupportedCurrencies\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesResponseContract;
use Yoelpc4\LaravelExchangeRate\Currency;

class SupportedCurrenciesResponse implements SupportedCurrenciesResponseContract
{
    /**
     * @var Currency[]
     */
    protected $currencies;

    /**
     * SupportedCurrenciesResponse constructor.
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
