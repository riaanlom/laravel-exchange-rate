<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\SupportedCurrenciesFactory as SupportedCurrenciesFactoryContract;
use Yoelpc4\LaravelExchangeRate\Currency;

class SupportedCurrenciesManager implements SupportedCurrenciesFactoryContract
{
    /**
     * @inheritDoc
     */
    public function make(string $contents)
    {
        $data = json_decode($contents, true);

        $currencies = array_map(function (array $results) {
            return new Currency($results['currencyName'], $results['id']);
        }, $data['results']);

        return new SupportedCurrencies($currencies);
    }
}
