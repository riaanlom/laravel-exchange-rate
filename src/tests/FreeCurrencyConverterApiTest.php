<?php

namespace Yoelpc4\LaravelExchangeRate\tests;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Exceptions\HistoricalExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\LatestExchangeRateException;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\HistoricalExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\LatestExchangeRate;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\TimeSeriesExchangeRate;

class FreeCurrencyConverterApiTest extends TestCase
{
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

            $this->assertTrue(
                $latestExchangeRate instanceof LatestExchangeRate &&
                $latestExchangeRate->base() === $base &&
                $latestExchangeRate->symbols() === $symbols &&
                count($latestExchangeRate->rates())
            );
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

            $this->assertTrue(
                $historicalExchangeRate instanceof HistoricalExchangeRate &&
                $historicalExchangeRate->base() === $base &&
                $historicalExchangeRate->symbols() === $symbols &&
                $historicalExchangeRate->date() === $date &&
                count($historicalExchangeRate->rates())
            );
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

            $this->assertTrue(
                $timeSeriesExchangeRate instanceof TimeSeriesExchangeRate &&
                $timeSeriesExchangeRate->base() === $base &&
                $timeSeriesExchangeRate->symbols() === $symbols &&
                $timeSeriesExchangeRate->startDate() === $startDate &&
                $timeSeriesExchangeRate->endDate() === $endDate &&
                count($timeSeriesExchangeRate->rates()) === (count($symbols) * ($dayDiff + 1))
            );
        } catch (GuzzleException $e) {
            throw $e;
        } catch (ValidationException $e) {
            throw $e;
        } catch (HistoricalExchangeRateException $e) {
            throw $e;
        }
    }
}
