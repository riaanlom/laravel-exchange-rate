<?php

namespace Yoelpc4\LaravelExchangeRate;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRateProvider provider(string $name = null)
 * @method static \Yoelpc4\LaravelExchangeRate\Currency[] currencies()
 * @method static \Yoelpc4\LaravelExchangeRate\ExchangeRate[] latest(string $base, $targets)
 * @method static \Yoelpc4\LaravelExchangeRate\ExchangeRate[] historical(string $base, $targets, string $date)
 * @method static \Yoelpc4\LaravelExchangeRate\ExchangeRate[] timeSeries(string $base, $targets, string $startDate, string $endDate)
 *
 * @see \Yoelpc4\LaravelExchangeRate\ExchangeRateServiceManager
 * @see \Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRateProvider
 */
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
