<?php

namespace Yoelpc4\LaravelExchangeRate\SupportedCurrencies\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Base\FreeCurrencyConverterApi\BaseRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrencies\SupportedCurrenciesRequestInterface;

class SupportedCurrenciesRequest extends BaseRequest implements SupportedCurrenciesRequestInterface
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
