<?php

namespace Yoelpc4\LaravelExchangeRate\Tests;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Currency;
use Yoelpc4\LaravelExchangeRate\ExchangeRate;

class FreeCurrencyConverterApiTest extends TestCase
{
    /**
     * Test successful get supported currencies data.
     *
     * @throws RequestException
     */
    public function testSuccessfulGetSupportedCurrencies()
    {
        try {
            $currencies = \ExchangeRateService::provider('free_currency_converter_api')
                ->currencies();

            foreach ($currencies as $currency) {
                $this->assertTrue($currency instanceof Currency);

                $this->assertTrue(is_string($currency->code()));

                $this->assertTrue(strlen($currency->code()) === 3);

                $this->assertTrue(is_string($currency->name()));

                $this->assertTrue(property_exists($currency, 'symbol'));
            }
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * Test successful get latest exchange rate data.
     *
     * @throws RequestException
     * @throws ValidationException
     */
    public function testSuccessfulGetLatestExchangeRate()
    {
        $base = 'IDR';

        $symbols = [
            'USD', 'DZD',
        ];

        try {
            $exchangeRates = \ExchangeRateService::provider('free_currency_converter_api')
                ->latest($base, $symbols);

            foreach ($exchangeRates as $exchangeRate) {
                $this->assertTrue($exchangeRate instanceof ExchangeRate);

                $this->assertTrue($exchangeRate->baseCurrency() === $base);

                $this->assertTrue(in_array($exchangeRate->targetCurrency(), $symbols));

                $this->assertTrue(Carbon::hasFormat($exchangeRate->date(), 'Y-m-d'));

                $this->assertTrue(is_numeric($exchangeRate->value()));
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * Test successful get historical exchange rate data.
     *
     * @throws RequestException
     * @throws ValidationException
     */
    public function testSuccessfulGetHistoricalExchangeRate()
    {
        $base = 'IDR';

        $symbols = [
            'USD', 'DZD',
        ];

        $date = now()->subDays(3)->toDateString();

        try {
            $exchangeRates = \ExchangeRateService::provider('free_currency_converter_api')
                ->historical($base, $symbols, $date);

            foreach ($exchangeRates as $exchangeRate) {
                $this->assertTrue($exchangeRate instanceof ExchangeRate);

                $this->assertTrue($exchangeRate->baseCurrency() === $base);

                $this->assertTrue(in_array($exchangeRate->targetCurrency(), $symbols));

                $this->assertTrue(Carbon::hasFormat($exchangeRate->date(), 'Y-m-d'));

                $this->assertTrue(is_numeric($exchangeRate->value()));
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * Test successful get time series exchange rate data.
     *
     * @throws RequestException
     * @throws ValidationException
     */
    public function testSuccessfulGetTimeSeriesExchangeRate()
    {
        $base = 'IDR';

        $symbols = [
            'USD', 'DZD',
        ];

        $dayDiff = 8;

        $startDate = now()->subDays($dayDiff)->toDateString();

        $endDate = now()->toDateString();

        try {
            $exchangeRates = \ExchangeRateService::provider('free_currency_converter_api')
                ->timeSeries($base, $symbols, $startDate, $endDate);

            foreach ($exchangeRates as $exchangeRate) {
                $this->assertTrue($exchangeRate instanceof ExchangeRate);

                $this->assertTrue($exchangeRate->baseCurrency() === $base);

                $this->assertTrue(in_array($exchangeRate->targetCurrency(), $symbols));

                $this->assertTrue(Carbon::hasFormat($exchangeRate->date(), 'Y-m-d'));

                $this->assertTrue(is_numeric($exchangeRate->value()));
            }

            $this->assertTrue(count($exchangeRates) === (count($symbols) * ($dayDiff + 1)));
        } catch (ValidationException $e) {
            throw $e;
        } catch (RequestException $e) {
            throw $e;
        }
    }
}
