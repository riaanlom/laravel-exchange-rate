<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Base;

use Yoelpc4\LaravelExchangeRate\Rate;

interface BaseResponseInterface
{
    /**
     * Get base response's base
     *
     * @return string
     */
    public function base();

    /**
     * Get base response's symbols
     *
     * @return array
     */
    public function symbols();

    /**
     * Get base response's rates
     *
     * @return Rate[]
     */
    public function rates();
}
