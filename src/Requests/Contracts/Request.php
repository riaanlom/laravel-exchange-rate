<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts;

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
}
