<?php

namespace Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrenciesInterface;

class SupportedCurrencies implements SupportedCurrenciesInterface
{
    /**
     * @var Currency[]
     */
    protected $currencies;

    /**
     * SupportedCurrencies constructor.
     *
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->currencies = array_map(function (array $data) {
            return new Currency($data);
        }, $data['results'] ?? []);
    }

    /**
     * @inheritDoc
     */
    public function currencies()
    {
        return $this->currencies;
    }
}
