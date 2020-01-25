<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

use Illuminate\Validation\Factory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Request as RequestContract;

abstract class Request implements RequestContract
{
    /**
     * Get request's data for validation
     *
     * @return array
     */
    abstract protected function data();

    /**
     * Get request's rules for validation
     *
     * @return array
     */
    abstract protected function rules();

    /**
     * Get request's messages for validation
     *
     * @return array
     */
    abstract protected function messages();

    /**
     * Get request's custom attributes for validation
     *
     * @return array
     */
    abstract protected function customAttributes();

    /**
     * @inheritDoc
     */
    abstract public function queryParams();

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
    public function validator()
    {
        return \App::make(Factory::class)
            ->make($this->data(), $this->rules(), $this->messages(), $this->customAttributes());
    }
}
