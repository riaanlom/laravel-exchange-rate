<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories;

use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\SupportedCurrenciesRequest;

interface SupportedCurrenciesRequestFactory
{
    /**
     * Create a new supported currencies handle instance.
     *
     * @return SupportedCurrenciesRequest
     */
    public function make();
}
