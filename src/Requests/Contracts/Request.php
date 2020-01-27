<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts;

interface Request
{
    /**
     * Get request's method
     *
     * @return string
     */
    public function method();

    /**
     * Get request's uri
     *
     * @return string
     */
    public function uri();

    /**
     * Get request's options
     *
     * @return array
     */
    public function options();
}
