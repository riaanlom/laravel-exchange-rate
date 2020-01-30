<?php

namespace Yoelpc4\LaravelExchangeRate\Tests;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\HistoricalExchangeRate;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\LatestExchangeRate;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\SupportedCurrencies;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRates\TimeSeriesExchangeRate;
use Yoelpc4\LaravelExchangeRate\Currency;
use Yoelpc4\LaravelExchangeRate\Rate;

class FreeCurrencyConverterApiTest extends TestCase
{
    /**
     * Test for successful get supported currencies data.
     *
     * @throws RequestException
     */
    public function testSuccessfulSupportedCurrencies()
    {
        try {
            $supportedCurrencies = \ExchangeRateService::supportedCurrencies();

            $this->assertTrue($supportedCurrencies instanceof SupportedCurrencies);

            $this->assertTrue(property_exists($supportedCurrencies, 'currencies'));

            foreach ($supportedCurrencies->currencies() as $currency) {
                $this->assertTrue($currency instanceof Currency);

                $this->assertTrue(property_exists($currency, 'name'));

                $this->assertTrue(property_exists($currency, 'symbol'));
            }
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * Test for successful get latest exchange rate data.
     *
     * @throws RequestException
     * @throws ValidationException
     */
    public function testSuccessfulLatestExchangeRate()
    {
        $base = 'IDR';

        $symbols = [
            'USD', 'DZD',
        ];

        try {
            $latestExchangeRate = \ExchangeRateService::latest($base, $symbols);

            $this->assertTrue($latestExchangeRate instanceof LatestExchangeRate);

            $this->assertTrue($latestExchangeRate->base() === $base);

            $this->assertTrue($latestExchangeRate->symbols() === $symbols);

            foreach ($latestExchangeRate->rates() as $rate) {
                $this->assertTrue($rate instanceof Rate);

                $this->assertTrue($rate->baseCurrency() === $base);

                $this->assertTrue(in_array($rate->targetCurrency(), $symbols));

                $this->assertTrue(property_exists($rate, 'date'));

                $this->assertTrue(property_exists($rate, 'value'));
            }
        } catch (RequestException $e) {
            throw $e;
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    /**
     * Test for successful get historical exchange rate data.
     *
     * @throws RequestException
     * @throws ValidationException
     */
    public function testSuccessfulHistoricalExchangeRate()
    {
        $base = 'IDR';

        $symbols = [
            'USD', 'DZD',
        ];

        $date = now()->subDays(3)->toDateString();

        try {
            $historicalExchangeRate = \ExchangeRateService::historical($base, $symbols, $date);

            $this->assertTrue($historicalExchangeRate instanceof HistoricalExchangeRate);

            $this->assertTrue($historicalExchangeRate->base() === $base);

            $this->assertTrue($historicalExchangeRate->symbols() === $symbols);

            $this->assertTrue($historicalExchangeRate->date() === $date);

            foreach ($historicalExchangeRate->rates() as $rate) {
                $this->assertTrue($rate instanceof Rate);

                $this->assertTrue($rate->baseCurrency() === $base);

                $this->assertTrue(in_array($rate->targetCurrency(), $symbols));

                $this->assertTrue(property_exists($rate, 'date'));

                $this->assertTrue(property_exists($rate, 'value'));
            }
        } catch (RequestException $e) {
            throw $e;
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    /**
     * Test for successful get time series exchange rate data.
     *
     * @throws RequestException
     * @throws ValidationException
     */
    public function testSuccessfulTimeSeriesExchangeRate()
    {
        $base = 'IDR';

        $symbols = [
            'USD', 'DZD',
        ];

        $dayDiff = 8;

        $startDate = now()->subDays($dayDiff)->toDateString();

        $endDate = now()->toDateString();

        try {
            $timeSeriesExchangeRate = \ExchangeRateService::timeSeries($base, $symbols, $startDate, $endDate);

            $this->assertTrue($timeSeriesExchangeRate instanceof TimeSeriesExchangeRate);

            $this->assertTrue($timeSeriesExchangeRate->base() === $base);

            $this->assertTrue($timeSeriesExchangeRate->symbols() === $symbols);

            $this->assertTrue($timeSeriesExchangeRate->startDate() === $startDate);

            $this->assertTrue($timeSeriesExchangeRate->endDate() === $endDate);

            foreach ($timeSeriesExchangeRate->rates() as $rate) {
                $this->assertTrue($rate instanceof Rate);

                $this->assertTrue($rate->baseCurrency() === $base);

                $this->assertTrue(in_array($rate->targetCurrency(), $symbols));

                $this->assertTrue(property_exists($rate, 'date'));

                $this->assertTrue(property_exists($rate, 'value'));
            }

            $this->assertTrue(count($timeSeriesExchangeRate->rates()) === (count($symbols) * ($dayDiff + 1)));
        } catch (RequestException $e) {
            throw $e;
        } catch (ValidationException $e) {
            throw $e;
        }
    }
}
