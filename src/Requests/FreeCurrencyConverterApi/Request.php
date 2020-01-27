<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

abstract class Request
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->apiKey = \Config::get('exchange-rate.providers.free_currency_converter_api.api_key');
    }
}
