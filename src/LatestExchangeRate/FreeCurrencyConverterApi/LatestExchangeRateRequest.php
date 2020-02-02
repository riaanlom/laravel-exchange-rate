<?php

namespace Yoelpc4\LaravelExchangeRate\LatestExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Base\FreeCurrencyConverterApi\BaseRequest;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRate\LatestExchangeRateRequestContract;
use Yoelpc4\LaravelExchangeRate\Contracts\MustValidated;
use Yoelpc4\LaravelExchangeRate\Utils\FreeCurrencyConverterApiUtil;

class LatestExchangeRateRequest extends BaseRequest implements LatestExchangeRateRequestContract, MustValidated
{
    use FreeCurrencyConverterApiUtil;

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
        parent::__construct();

        $this->base = $base;

        $this->symbols = $symbols;
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
    public function query()
    {
        return [
            'apiKey'  => $this->apiKey,
            'q'       => $this->makeQuery(),
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
            'base'      => \Lang::get('laravel-exchange-rate::validation.attributes.base'),
            'symbols'   => \Lang::get('laravel-exchange-rate::validation.attributes.symbols'),
            'symbols.*' => \Lang::get('laravel-exchange-rate::validation.attributes.symbol'),
        ];
    }
}
