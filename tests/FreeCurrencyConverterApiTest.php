<?php

namespace Yoelpc4\LaravelExchangeRate\Tests;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Exceptions\HistoricalExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\LatestExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\SupportedCurrenciesException;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\HistoricalExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\LatestExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\SupportedCurrencies;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\TimeSeriesExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Currency;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Rate;

class FreeCurrencyConverterApiTest extends TestCase
{
    /**
     * Test for successful get supported currencies data.
     *
     * @throws GuzzleException
     * @throws SupportedCurrenciesException
     */
    public function testSuccessfulSupportedCurrencies()
    {
        try {
            $supportedCurrencies = \ExchangeRate::supportedCurrencies();

            $this->assertTrue($supportedCurrencies instanceof SupportedCurrencies);

            $this->assertTrue(property_exists($supportedCurrencies, 'currencies'));

            foreach ($supportedCurrencies->currencies() as $currency) {
                $this->assertTrue($currency instanceof Currency);

                $this->assertTrue(property_exists($currency, 'name'));

                $this->assertTrue(property_exists($currency, 'symbol'));
            }
        } catch (GuzzleException $e) {
            throw $e;
        } catch (SupportedCurrenciesException $e) {
            throw $e;
        }
    }

    /**
     * Test for successful get latest exchange rate data.
     *
     * @throws GuzzleException
     * @throws LatestExchangeRateException
     * @throws ValidationException
     */
    public function testSuccessfulLatestExchangeRate()
    {
        $base = 'IDR';

        $symbols = [
            'USD', 'DZD',
        ];

        try {
            $latestExchangeRate = \ExchangeRate::latest($base, $symbols);

            $this->assertTrue($latestExchangeRate instanceof LatestExchangeRate);

            $this->assertTrue($latestExchangeRate->base() === $base);

            $this->assertTrue($latestExchangeRate->symbols() === $symbols);

            foreach ($latestExchangeRate->rates() as $rate) {
                $this->assertTrue($rate instanceof Rate);

                $this->assertTrue($rate->fromCurrency() === $base);

                $this->assertTrue(in_array($rate->toCurrency(), $symbols));

                $this->assertTrue(property_exists($rate, 'date'));

                $this->assertTrue(property_exists($rate, 'value'));
            }
        } catch (GuzzleException $e) {
            throw $e;
        } catch (ValidationException $e) {
            throw $e;
        } catch (LatestExchangeRateException $e) {
            throw $e;
        }
    }

    /**
     * Test for successful get historical exchange rate data.
     *
     * @throws GuzzleException
     * @throws HistoricalExchangeRateException
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
            $historicalExchangeRate = \ExchangeRate::historical($base, $symbols, $date);

            $this->assertTrue($historicalExchangeRate instanceof HistoricalExchangeRate);

            $this->assertTrue($historicalExchangeRate->base() === $base);

            $this->assertTrue($historicalExchangeRate->symbols() === $symbols);

            $this->assertTrue($historicalExchangeRate->date() === $date);

            foreach ($historicalExchangeRate->rates() as $rate) {
                $this->assertTrue($rate instanceof Rate);

                $this->assertTrue($rate->fromCurrency() === $base);

                $this->assertTrue(in_array($rate->toCurrency(), $symbols));

                $this->assertTrue(property_exists($rate, 'date'));

                $this->assertTrue(property_exists($rate, 'value'));
            }
        } catch (GuzzleException $e) {
            throw $e;
        } catch (ValidationException $e) {
            throw $e;
        } catch (HistoricalExchangeRateException $e) {
            throw $e;
        }
    }

    /**
     * Test for successful get time series exchange rate data.
     *
     * @throws GuzzleException
     * @throws HistoricalExchangeRateException
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
            $timeSeriesExchangeRate = \ExchangeRate::timeSeries($base, $symbols, $startDate, $endDate);

            $this->assertTrue($timeSeriesExchangeRate instanceof TimeSeriesExchangeRate);

            $this->assertTrue($timeSeriesExchangeRate->base() === $base);

            $this->assertTrue($timeSeriesExchangeRate->symbols() === $symbols);

            $this->assertTrue($timeSeriesExchangeRate->startDate() === $startDate);

            $this->assertTrue($timeSeriesExchangeRate->endDate() === $endDate);

            foreach ($timeSeriesExchangeRate->rates() as $rate) {
                $this->assertTrue($rate instanceof Rate);

                $this->assertTrue($rate->fromCurrency() === $base);

                $this->assertTrue(in_array($rate->toCurrency(), $symbols));

                $this->assertTrue(property_exists($rate, 'date'));

                $this->assertTrue(property_exists($rate, 'value'));
            }

            $this->assertTrue(count($timeSeriesExchangeRate->rates()) === (count($symbols) * ($dayDiff + 1)));
        } catch (GuzzleException $e) {
            throw $e;
        } catch (ValidationException $e) {
            throw $e;
        } catch (HistoricalExchangeRateException $e) {
            throw $e;
        }
    }
}
