<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Requests\Contracts\LatestRequest as LatestRequestContract;

class LatestRequest extends Request implements LatestRequestContract
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
     * LatestRequest constructor.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     */
    public function __construct(string $base, $symbols)
    {
        $this->base = strtoupper($base);

        $this->symbols = $this->makeSymbols($symbols);
    }

    /**
     * @inheritDoc
     */
    protected function data()
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
    protected function rules()
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
    protected function messages()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function customAttributes()
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
    public function queryParams()
    {
        return [
            'apiKey'  => \Config::get('exchange-rate.services.free_currency_converter_api.api_key'),
            'q'       => $this->makeQuery(),
            'compact' => 'ultra',
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
