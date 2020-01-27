<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts;

interface LatestExchangeRateRequest extends Request
{
    /**
     * Get latest exchange rate handle's base
     *
     * @return string
     */
    public function base();

    /**
     * Get latest exchange rate handle's symbols
     *
     * @return array
     */
    public function symbols();
}
