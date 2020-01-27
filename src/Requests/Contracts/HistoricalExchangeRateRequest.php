<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts;

interface HistoricalExchangeRateRequest extends Request
{
    /**
     * Get historical exchange rate handle's base
     *
     * @return string
     */
    public function base();

    /**
     * Get historical exchange rate handle's symbols
     *
     * @return array
     */
    public function symbols();

    /**
     * Get historical exchange rate handle's date
     *
     * @return string
     */
    public function date();
}
