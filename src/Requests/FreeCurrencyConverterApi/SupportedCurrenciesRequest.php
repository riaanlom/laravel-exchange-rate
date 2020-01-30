<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\Requests\SupportedCurrenciesRequest as RequestContract;

class SupportedCurrenciesRequest extends Request implements RequestContract
{
    /**
     * @var string
     */
    protected $uri = 'currencies';

    /**
     * @inheritDoc
     */
    public function query()
    {
        return [
            'apiKey' => $this->apiKey,
        ];
    }
}
