<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts;

interface Request
{
    /**
     * Get handle's method
     *
     * @return string
     */
    public function method();

    /**
     * Get handle's uri
     *
     * @return string
     */
    public function uri();

    /**
     * Get handle's options
     *
     * @return array
     */
    public function options();
}
