<?php

namespace Yoelpc4\LaravelExchangeRate\SupportedCurrencies\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesFactoryInterface;
use Yoelpc4\LaravelExchangeRate\Currency;

class SupportedCurrenciesFactory implements SupportedCurrenciesFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function makeResponse(string $contents)
    {
        $data = json_decode($contents, true);

        $currencies = array_map(function (array $results) {
            return new Currency($results['currencyName'], $results['id']);
        }, $data['results']);

        return new SupportedCurrenciesResponse($currencies);
    }
}