<?php

namespace Yoelpc4\LaravelExchangeRate\Facades;

use Illuminate\Support\Facades\Facade;

class ExchangeRateService extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'exchange_rate_service';
    }
}
