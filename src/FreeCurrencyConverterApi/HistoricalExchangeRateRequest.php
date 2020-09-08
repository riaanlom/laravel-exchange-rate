<?php

namespace Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Concerns\FreeCurrencyConverterApiFormatter;
use Yoelpc4\LaravelExchangeRate\Concerns\Request;
use Yoelpc4\LaravelExchangeRate\Contracts\Requestable;
use Yoelpc4\LaravelExchangeRate\Contracts\Validatable;

class HistoricalExchangeRateRequest implements Requestable, Validatable
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
    public $targets;

    /**
     * @var string
     */
    public $date;

    /**
     * HistoricalExchangeRateRequest constructor.
     *
     * @param  string  $apiKey
     * @param  string  $base
     * @param  string|array  $targets
     * @param  string  $date
     */
    public function __construct(string $apiKey, string $base, $targets, string $date)
    {
        $this->apiKey = $apiKey;

        $this->base = strtoupper($base);

        $this->targets = $this->formatTargets($targets);

        $this->date = $date;
    }

    /**
     * @inheritDoc
     */
    public function query()
    {
        return [
            'apiKey'  => $this->apiKey,
            'q'       => $this->formatQuery(),
            'date'    => $this->date,
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
            'targets' => $this->targets,
            'date'    => $this->date,
        ];
    }

    /**
     * @inheritDoc
     * @see https://free.currencyconverterapi.com/
     * @referencedAt 2020-01-24
     */
    public function rules()
    {
        $aYearAgo = now()->subYear()->subDay()->toDateString();

        return [
            'base'      => 'required|string|size:3',
            'targets'   => 'required|array|between:1,2',
            'targets.*' => 'required|string|size:3',
            'date'      => "required|string|date|date_format:Y-m-d|after:{$aYearAgo}|before:tomorrow",
        ];
    }

    /**
     * @inheritDoc
     */
    public function messages()
    {
        return [
            'date.after'  => __('laravel-exchange-rate::validation.custom.after_a_year_ago', [
                'attribute' => __('laravel-exchange-rate::validation.attributes.date'),
            ]),
            'date.before' => __('laravel-exchange-rate::validation.custom.before_tomorrow', [
                'attribute' => __('laravel-exchange-rate::validation.attributes.date'),
            ]),
        ];
    }

    /**
     * @inheritDoc
     */
    public function customAttributes()
    {
        return [
            'base'      => __('laravel-exchange-rate::validation.attributes.base'),
            'targets'   => __('laravel-exchange-rate::validation.attributes.targets'),
            'targets.*' => __('laravel-exchange-rate::validation.attributes.target'),
            'date'      => __('laravel-exchange-rate::validation.attributes.date'),
        ];
    }
}
