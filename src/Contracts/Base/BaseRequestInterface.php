<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Base;

interface BaseRequestInterface
{
    /**
     * Get base request's method
     *
     * @return string
     */
    public function method();

    /**
     * Get base request's uri
     *
     * @return string
     */
    public function uri();

    /**
     * Get base request's query
     *
     * @return array
     */
    public function query();
}