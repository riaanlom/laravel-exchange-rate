<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Illuminate\Support\Carbon;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\MustValidated;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\TimeSeriesExchangeRateRequest as TimeSeriesExchangeRateRequestContract;

class TimeSeriesExchangeRateRequest implements TimeSeriesExchangeRateRequestContract, MustValidated
{
    use Util;

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
     * @param  string  $base
     * @param  mixed  $symbols
     * @param  string  $startDate
     * @param  string  $endDate
     */
    public function __construct(string $base, $symbols, string $startDate, string $endDate)
    {
        $this->base = $base;

        $this->symbols = $symbols;

        $this->startDate = $startDate;

        $this->endDate = $endDate;
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
                'date'    => $this->startDate,
                'endDate' => $this->endDate,
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
            'start_date.before' => \Lang::get('validation.before', [
                'attribute' => \Lang::get('laravel-exchange-rate::validation.attributes.start_date'),
                'date'      => \Lang::get('laravel-exchange-rate::validation.attributes.end_date'),
            ]),
            'start_date.after'  => \Lang::get('laravel-exchange-rate::validation.custom.a_year_ago', [
                'attribute' => \Lang::get('laravel-exchange-rate::validation.attributes.start_date'),
            ]),
            'end_date.before'   => \Lang::get('laravel-exchange-rate::validation.custom.days_period_after_or_before_tomorrow',
                [
                    'attribute' => \Lang::get('laravel-exchange-rate::validation.attributes.end_date'),
                    'days'      => '8',
                    'date'      => \Lang::get('laravel-exchange-rate::validation.attributes.start_date'),
                ]),
            'end_date.after'    => \Lang::get('validation.after', [
                'attribute' => \Lang::get('laravel-exchange-rate::validation.attributes.end_date'),
                'date'      => \Lang::get('laravel-exchange-rate::validation.attributes.start_date'),
            ]),
        ];
    }

    /**
     * @inheritDoc
     */
    public function customAttributes()
    {
        return [
            'base'       => \Lang::get('laravel-exchange-rate::validation.attributes.base'),
            'symbols'    => \Lang::get('laravel-exchange-rate::validation.attributes.symbols'),
            'symbols.*'  => \Lang::get('laravel-exchange-rate::validation.attributes.symbol'),
            'start_date' => \Lang::get('laravel-exchange-rate::validation.attributes.start_date'),
            'end_date'   => \Lang::get('laravel-exchange-rate::validation.attributes.end_date'),
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
    public function startDate()
    {
        return $this->startDate;
    }

    /**
     * @inheritDoc
     */
    public function endDate()
    {
        return $this->endDate;
    }
}
