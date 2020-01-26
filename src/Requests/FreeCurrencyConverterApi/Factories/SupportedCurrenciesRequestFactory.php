<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Factories;

use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\SupportedCurrenciesRequestFactory as SupportedCurrenciesRequestFactoryContract;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\SupportedCurrenciesRequest;

class SupportedCurrenciesRequestFactory implements SupportedCurrenciesRequestFactoryContract
{
    /**
     * @inheritDoc
     */
    public function make()
    {
        return new SupportedCurrenciesRequest;
    }
}
