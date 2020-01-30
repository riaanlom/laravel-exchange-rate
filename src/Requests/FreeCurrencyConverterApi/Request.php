<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

abstract class Request
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var string
     */
    protected $uri = 'convert';

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->apiKey = \Config::get('exchange-rate.providers.free_currency_converter_api.api_key');
    }

    /**
     * @inheritDoc
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     */
    public function uri()
    {
        return $this->uri;
    }
}
