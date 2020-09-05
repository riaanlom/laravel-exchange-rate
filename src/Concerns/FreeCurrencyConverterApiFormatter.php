<?php

namespace Yoelpc4\LaravelExchangeRate\Concerns;

trait FreeCurrencyConverterApiFormatter
{
    /**
     * Format free currency converter api query
     *
     * @return string
     */
    protected function formatQuery()
    {
        $queries = array_map(function (string $symbol) {
            return "{$this->base}_{$symbol}";
        }, $this->symbols);

        return implode(',', $queries);
    }

    /**
     * Format free currency converter api symbols
     *
     * @param  string|array  $symbols
     * @return array
     */
    protected function formatSymbols($symbols)
    {
        return array_map(function (string $symbol) {
            return strtoupper($symbol);
        }, \Arr::wrap($symbols));
    }
}
