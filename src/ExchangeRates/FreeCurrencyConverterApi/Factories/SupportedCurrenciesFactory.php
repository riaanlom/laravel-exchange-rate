<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\Factories;

use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\SupportedCurrenciesFactory as SupportedCurrenciesFactoryContract;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Currency;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\FreeCurrencyConverterApi\SupportedCurrencies;

class SupportedCurrenciesFactory implements SupportedCurrenciesFactoryContract
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
