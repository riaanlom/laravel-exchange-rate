<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts;

use Illuminate\Contracts\Validation\Validator;

interface Request
{
    /**
     * Get request's uri
     *
     * @return string
     */
    public function uri();

    /**
     * Get request's query params
     *
     * @return array
     */
    public function queryParams();

    /**
     * Get request's validator
     *
     * @return Validator
     */
    public function validator();
}
