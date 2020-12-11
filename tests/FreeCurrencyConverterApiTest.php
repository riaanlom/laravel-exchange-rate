<?php

namespace Yoelpc4\LaravelExchangeRate\Tests;

use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Psr\Http\Client\ClientExceptionInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\CurrencyInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRateInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\HistoricalExchangeRateInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\LatestExchangeRateInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\SupportedCurrenciesInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\TimeSeriesExchangeRateInterface;
use Yoelpc4\LaravelExchangeRate\ExchangeRateService;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi;

class FreeCurrencyConverterApiTest extends TestCase
{
    /**
     *
     */
    public function testExpectedProvider()
    {
        $exchangeRateService = ExchangeRateService::provider('free_currency_converter_api');

        $this->assertInstanceOf(FreeCurrencyConverterApi::class, $exchangeRateService);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testSuccessfulGetSupportedCurrencies()
    {
        try {
            $supportedCurrencies = ExchangeRateService::provider('free_currency_converter_api')
                ->currencies();
        } catch (ClientExceptionInterface $e) {
            throw $e;
        }

        $this->assertInstanceOf(SupportedCurrenciesInterface::class, $supportedCurrencies);

        foreach ($supportedCurrencies->currencies() as $currency) {
            $this->assertTrue($currency instanceof CurrencyInterface);

            $this->assertTrue(is_string($currency->code()));

            $this->assertTrue(strlen($currency->code()) === 3);

            $this->assertTrue(is_string($currency->name()));
        }
    }

    /**
     * @throws ValidationException
     * @throws ClientExceptionInterface
     */
    public function testSuccessfulGetLatestExchangeRate()
    {
        $base = 'IDR';

        $targets = [
            'USD', 'DZD',
        ];

        try {
            $latestExchangeRates = ExchangeRateService::provider('free_currency_converter_api')
                ->latest($base, $targets);
        } catch (ValidationException $e) {
            throw $e;
        } catch (ClientExceptionInterface $e) {
            throw $e;
        }

        $this->assertInstanceOf(LatestExchangeRateInterface::class, $latestExchangeRates);


        foreach ($latestExchangeRates->exchangeRates() as $exchangeRate) {
            $this->assertTrue($exchangeRate instanceof ExchangeRateInterface);

            $this->assertTrue($exchangeRate->baseCurrency() === $base);

            $this->assertTrue(in_array($exchangeRate->targetCurrency(), $targets));

            $this->assertTrue(Carbon::hasFormat($exchangeRate->date(), 'Y-m-d'));

            $this->assertTrue(is_numeric($exchangeRate->value()));
        }
    }

    /**
     * @throws ValidationException
     * @throws ClientExceptionInterface
     */
    public function testSuccessfulGetHistoricalExchangeRate()
    {
        $base = 'IDR';

        $targets = [
            'USD', 'DZD',
        ];

        $date = now()->subDays(3)->toDateString();

        try {
            $historicalExchangeRates = ExchangeRateService::provider('free_currency_converter_api')
                ->historical($base, $targets, $date);
        } catch (ValidationException $e) {
            throw $e;
        } catch (ClientExceptionInterface $e) {
            throw $e;
        }

        $this->assertInstanceOf(HistoricalExchangeRateInterface::class, $historicalExchangeRates);


        foreach ($historicalExchangeRates->exchangeRates() as $exchangeRate) {
            $this->assertTrue($exchangeRate instanceof ExchangeRateInterface);

            $this->assertTrue($exchangeRate->baseCurrency() === $base);

            $this->assertTrue(in_array($exchangeRate->targetCurrency(), $targets));

            $this->assertTrue(Carbon::hasFormat($exchangeRate->date(), 'Y-m-d'));

            $this->assertTrue(is_numeric($exchangeRate->value()));
        }
    }

    /**
     * @throws ValidationException
     * @throws ClientExceptionInterface
     */
    public function testSuccessfulGetTimeSeriesExchangeRate()
    {
        $base = 'IDR';

        $targets = [
            'USD', 'DZD',
        ];

        $dayDiff = 8;

        $startDate = now()->subDays($dayDiff)->toDateString();

        $endDate = now()->toDateString();

        try {
            $timeSeriesExchangeRates = ExchangeRateService::provider('free_currency_converter_api')
                ->timeSeries($base, $targets, $startDate, $endDate);
        } catch (ValidationException $e) {
            throw $e;
        } catch (ClientExceptionInterface $e) {
            throw $e;
        }

        $this->assertInstanceOf(TimeSeriesExchangeRateInterface::class, $timeSeriesExchangeRates);

        foreach ($timeSeriesExchangeRates->exchangeRates() as $exchangeRate) {
            $this->assertTrue($exchangeRate instanceof ExchangeRateInterface);

            $this->assertTrue($exchangeRate->baseCurrency() === $base);

            $this->assertTrue(in_array($exchangeRate->targetCurrency(), $targets));

            $this->assertTrue(Carbon::hasFormat($exchangeRate->date(), 'Y-m-d'));

            $this->assertTrue(is_numeric($exchangeRate->value()));
        }

        $this->assertTrue(count($timeSeriesExchangeRates->exchangeRates()) === (count($targets) * ($dayDiff + 1)));
    }
}
