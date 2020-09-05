<?php

namespace Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi;

use Illuminate\Support\Carbon;
use Yoelpc4\LaravelExchangeRate\Concerns\FreeCurrencyConverterApiFormatter;
use Yoelpc4\LaravelExchangeRate\Concerns\Request;
use Yoelpc4\LaravelExchangeRate\Contracts\Requestable;
use Yoelpc4\LaravelExchangeRate\Contracts\Validatable;

class TimeSeriesExchangeRateRequest implements Requestable, Validatable
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
     * @var string
     */
    public $startDate;

    /**
     * @var string
     */
    public $endDate;

    /**
     * TimeSeriesExchangeRateRequest constructor.
     *
     * @param  string  $apiKey
     * @param  string  $base
     * @param  string|array  $symbols
     * @param  string  $startDate
     * @param  string  $endDate
     */
    public function __construct(string $apiKey, string $base, $symbols, string $startDate, string $endDate)
    {
        $this->apiKey = $apiKey;

        $this->base = strtoupper($base);

        $this->symbols = $this->formatSymbols($symbols);

        $this->startDate = $startDate;

        $this->endDate = $endDate;
    }

    /**
     * @inheritDoc
     */
    public function query()
    {
        return [
            'apiKey'  => $this->apiKey,
            'q'       => $this->formatQuery(),
            'date'    => $this->startDate,
            'endDate' => $this->endDate,
            'compact' => 'ultra',
        ];
    }

    /**
     * @inheritDoc
     */
    public function data()
    {
        return [
            'base'       => $this->base,
            'symbols'    => $this->symbols,
            'start_date' => $this->startDate,
            'end_date'   => $this->endDate,
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

        $nineDaysAfterTheStartDate = Carbon::parse($this->startDate)->addDays(9)->toDateString();

        return [
            'base'       => 'required|string|size:3',
            'symbols'    => 'required|array|min:1|between:1,2',
            'symbols.*'  => 'required|string|size:3',
            'start_date' => "required|string|date|date_format:Y-m-d|after:{$aYearAgo}|before:end_date",
            'end_date'   => "required|string|date|date_format:Y-m-d|after:start_date|before:tomorrow|before:{$nineDaysAfterTheStartDate}",
        ];
    }

    /**
     * @inheritDoc
     */
    public function messages()
    {
        return [
            'start_date.before' => __('validation.before_tomorrow', [
                'attribute' => __('laravel-exchange-rate::validation.attributes.start_date'),
                'date'      => __('laravel-exchange-rate::validation.attributes.end_date'),
            ]),
            'start_date.after'  => __('laravel-exchange-rate::validation.custom.after_a_year_ago', [
                'attribute' => __('laravel-exchange-rate::validation.attributes.start_date'),
            ]),
            'end_date.before'   => __('laravel-exchange-rate::validation.custom.days_period_after_or_before_tomorrow',
                [
                    'attribute' => __('laravel-exchange-rate::validation.attributes.end_date'),
                    'days'      => '8',
                    'date'      => __('laravel-exchange-rate::validation.attributes.start_date'),
                ]
            ),
            'end_date.after'    => __('validation.after', [
                'attribute' => __('laravel-exchange-rate::validation.attributes.end_date'),
                'date'      => __('laravel-exchange-rate::validation.attributes.start_date'),
            ]),
        ];
    }

    /**
     * @inheritDoc
     */
    public function customAttributes()
    {
        return [
            'base'       => __('laravel-exchange-rate::validation.attributes.base'),
            'symbols'    => __('laravel-exchange-rate::validation.attributes.symbols'),
            'symbols.*'  => __('laravel-exchange-rate::validation.attributes.symbol'),
            'start_date' => __('laravel-exchange-rate::validation.attributes.start_date'),
            'end_date'   => __('laravel-exchange-rate::validation.attributes.end_date'),
        ];
    }
}
