<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

interface CurrencyInterface
{
    /**
     * Get currency's code
     *
     * @return string
     */
    public function code();

    /**
     * Get currency's name
     *
     * @return string
     */
    public function name();

    /**
     * Get currency's symbol
     *
     * @return string|null
     */
    public function symbol();
}
