<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Requests\Contracts\SupportedCurrenciesRequest as SupportedCurrenciesRequestContract;

class SupportedCurrenciesRequest extends Request implements SupportedCurrenciesRequestContract
{
    /**
     * @inheritDoc
     */
    public function method()
    {
        return 'GET';
    }

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
    public function options()
    {
        return [
            'query' => [
                'apiKey'  => $this->apiKey,
            ],
        ];
    }
}
