<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Requests\Contracts\LatestExchangeRateRequest as LatestExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\MustValidated;

class LatestExchangeRateRequest implements LatestExchangeRateRequestContract, MustValidated
{
    use Util;

    /**
     * @var string
     */
    protected $base;

    /**
     * @var array
     */
    protected $symbols;

    /**
     * LatestExchangeRateRequest constructor.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     */
    public function __construct(string $base, $symbols)
    {
        $this->base = $base;

        $this->symbols = $symbols;
    }

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
        return 'convert';
    }

    /**
     * @inheritDoc
     */
    public function options()
    {
        return [
            'query' => [
                'apiKey'  => \Config::get('exchange-rate.providers.free_currency_converter_api.api_key'),
                'q'       => $this->makeQuery(),
                'compact' => 'ultra',
            ],
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
            'base'      => \Lang::get('laravel-exchange-rate::validation.attributes.base'),
            'symbols'   => \Lang::get('laravel-exchange-rate::validation.attributes.symbols'),
            'symbols.*' => \Lang::get('laravel-exchange-rate::validation.attributes.symbol'),
        ];
    }


    /**
     * @inheritDoc
     */
    public function base()
    {
        return $this->base;
    }

    /**
     * @inheritDoc
     */
    public function symbols()
    {
        return $this->symbols;
    }
}
