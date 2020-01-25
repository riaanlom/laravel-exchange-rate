<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Requests\Contracts\HistoricalRequest as HistoricalRequestContract;

class HistoricalRequest extends Request implements HistoricalRequestContract
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
     * @var string
     */
    protected $date;

    /**
     * HistoricalRequest constructor.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $date
     */
    public function __construct(string $base, $symbols, string $date)
    {
        $this->base = strtoupper($base);

        $this->symbols = $this->makeSymbols($symbols);

        $this->date = $date;
    }

    /**
     * @inheritDoc
     */
    protected function data()
    {
        return [
            'base'    => $this->base,
            'symbols' => $this->symbols,
            'date'    => $this->date,
        ];
    }

    /**
     * @inheritDoc
     * @see https://free.currencyconverterapi.com/
     * @referencedAt 2020-01-24
     */
    protected function rules()
    {
        $aYearAgo = now()->subYear()->subDay()->toDateString();

        return [
            'base'      => 'required|string|size:3',
            'symbols'   => 'required|array|min:1|between:1,2',
            'symbols.*' => 'required|string|size:3',
            'date'      => "required|string|date|date_format:Y-m-d|after:{$aYearAgo}|before:tomorrow",
        ];
    }

    /**
     * @inheritDoc
     */
    protected function messages()
    {
        return [
            'date.after'  => \Lang::get('laravel-exchange-rate::validation.custom.a_year_ago', [
                'attribute' => \Lang::get('laravel-exchange-rate::validation.attributes.date'),
            ]),
            'date.before' => \Lang::get('validation.before', [
                'attribute' => \Lang::get('laravel-exchange-rate::validation.attributes.date'),
                'date'      => \Lang::get('laravel-exchange-rate::validation.attributes.tomorrow'),
            ]),
        ];
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
            'date'      => \Lang::get('laravel-exchange-rate::validation.attributes.date'),
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
            'date'    => $this->date,
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

    /**
     * @inheritDoc
     */
    public function date()
    {
        return $this->date;
    }
}
