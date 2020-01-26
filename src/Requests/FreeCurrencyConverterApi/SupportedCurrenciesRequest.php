<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Requests\Contracts\SupportedCurrenciesRequest as SupportedCurrenciesRequestContract;

class SupportedCurrenciesRequest implements SupportedCurrenciesRequestContract
{
    /**
     * @inheritDoc
     */
    public function uri()
    {
        return 'currencies';
    }

    /**
     * @inheritDoc
     */
    public function queryParams()
    {
        return [
            'apiKey'  => \Config::get('exchange-rate.providers.free_currency_converter_api.api_key'),
        ];
    }
}
