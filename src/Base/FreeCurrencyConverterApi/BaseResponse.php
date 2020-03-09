<?php

namespace Yoelpc4\LaravelExchangeRate\Base\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\Base\BaseResponseInterface;
use Yoelpc4\LaravelExchangeRate\Rate;

abstract class BaseResponse implements BaseResponseInterface
{
    /**
     * @var string
     */
    protected $base;

    /**
     * @var array
     */
    protected $symbols;

    /**
     * @var Rate[]
     */
    protected $rates;

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
    public function rates()
    {
        return $this->rates;
    }
}
