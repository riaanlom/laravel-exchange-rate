<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi;

trait Util
{
    /**
     * Create free currency converter api query
     *
     * @return string
     */
    protected function makeQuery()
    {
        $queries = array_map(function (string $symbol) {
            return "{$this->base}_{$symbol}";
        }, $this->symbols);

        return implode(',', $queries);
    }

    /**
     * Create free currency converter api symbols
     *
     * @param  mixed  $symbols
     * @return array
     */
    protected function makeSymbols($symbols)
    {
        return array_map(function (string $symbol) {
            return strtoupper($symbol);
        }, \Arr::wrap($symbols));
    }
}
