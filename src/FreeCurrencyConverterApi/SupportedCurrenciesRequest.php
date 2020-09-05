<?php

namespace Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Concerns\Request;
use Yoelpc4\LaravelExchangeRate\Contracts\Requestable;

class SupportedCurrenciesRequest implements Requestable
{
    use Request;

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
    protected $endpoint = 'currencies';

    /**
     * SupportedCurrenciesRequest constructor.
     *
     * @param  string  $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Get request's query
     *
     * @return array
     */
    public function query()
    {
        return [
            'apiKey' => $this->apiKey,
        ];
    }
}
