<?php

namespace Yoelpc4\LaravelExchangeRate\Facades;

use Illuminate\Support\Facades\Facade;

class ExchangeRate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'yoelpc4.exchange_rate';
    }
}
