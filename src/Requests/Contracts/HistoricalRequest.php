<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts;

interface HistoricalRequest extends Request
{
    /**
     * Get historical exchange rate request's base
     *
     * @return string
     */
    public function base();

    /**
     * Get historical exchange rate request's symbols
     *
     * @return array
     */
    public function symbols();

    /**
     * Get historical exchange rate request's date
     *
     * @return string
     */
    public function date();
}
