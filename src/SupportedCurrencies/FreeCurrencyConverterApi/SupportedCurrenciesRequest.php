<?php

namespace Yoelpc4\LaravelExchangeRate\SupportedCurrencies\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Base\FreeCurrencyConverterApi\BaseRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesRequestContract;

class SupportedCurrenciesRequest extends BaseRequest implements SupportedCurrenciesRequestContract
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
