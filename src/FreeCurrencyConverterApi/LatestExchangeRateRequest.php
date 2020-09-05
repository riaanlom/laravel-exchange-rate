<?php

namespace Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Concerns\FreeCurrencyConverterApiFormatter;
use Yoelpc4\LaravelExchangeRate\Concerns\Request;
use Yoelpc4\LaravelExchangeRate\Contracts\Requestable;
use Yoelpc4\LaravelExchangeRate\Contracts\Validatable;

class LatestExchangeRateRequest implements Requestable, Validatable
{
    use Request, FreeCurrencyConverterApiFormatter;

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
    protected $endpoint = 'convert';

    /**
     * @var string
     */
    public $base;

    /**
     * @var array
     */
    public $symbols;

    /**
     * LatestExchangeRateRequest constructor.
     *
     * @param  string  $apiKey
     * @param  string  $base
     * @param  array  $symbols
     */
    public function __construct(string $apiKey, string $base, array $symbols)
    {
        $this->apiKey = $apiKey;

        $this->base = $base;

        $this->symbols = $symbols;
    }

    /**
     * @inheritDoc
     */
    public function query()
    {
        return [
            'apiKey'  => $this->apiKey,
            'q'       => $this->formatQuery(),
            'compact' => 'ultra',
        ];
    }

    /**
     * @inheritDoc
     */
    public function data()
    {
        return [
            'base'    => $this->base,
            'symbols' => $this->symbols,
        ];
    }

    /**
     * @inheritDoc
     * @see https://free.currencyconverterapi.com/
     * @referencedAt 2020-01-24
     */
    public function rules()
    {
        return [
            'base'      => 'required|string|size:3',
            'symbols'   => 'required|array|between:1,2',
            'symbols.*' => 'required|string|size:3',
        ];
    }

    /**
     * @inheritDoc
     */
    public function messages()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function customAttributes()
    {
        return [
            'base'      => __('laravel-exchange-rate::validation.attributes.base'),
            'symbols'   => __('laravel-exchange-rate::validation.attributes.symbols'),
            'symbols.*' => __('laravel-exchange-rate::validation.attributes.symbol'),
        ];
    }
}
