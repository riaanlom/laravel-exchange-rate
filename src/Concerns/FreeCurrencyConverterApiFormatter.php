<?php

namespace Yoelpc4\LaravelExchangeRate\Concerns;

use Illuminate\Support\Arr;

trait FreeCurrencyConverterApiFormatter
{
    /**
     * Format free currency converter api query
     *
     * @return string
     */
    protected function formatQuery()
    {
        $queries = array_map(function (string $target) {
            return "{$this->base}_{$target}";
        }, $this->targets);

        return implode(',', $queries);
    }

    /**
     * Format free currency converter api targets
     *
     * @param  string|array  $targets
     * @return array
     */
    protected function formatTargets($targets)
    {
        return array_map(function (string $target) {
            return strtoupper($target);
        }, Arr::wrap($targets));
    }
}
