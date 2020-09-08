<?php

namespace Yoelpc4\LaravelExchangeRate;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Concerns\Response;
use Yoelpc4\LaravelExchangeRate\Concerns\Validation;
use Yoelpc4\LaravelExchangeRate\Contracts\Api\Api;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRateProvider;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\HistoricalExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\LatestExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\SupportedCurrenciesRequest;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\TimeSeriesExchangeRateRequest;

class FreeCurrencyConverterApiProvider implements ExchangeRateProvider
{
    use Response, Validation;

    /**
     * @var Api
     */
    protected $api;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * FreeCurrencyConverterApiProvider constructor.
     *
     * @param  Api  $api
     * @param  string  $apiKey
     */
    public function __construct(Api $api, string $apiKey)
    {
        $this->api = $api;

        $this->apiKey = $apiKey;
    }

    /**
     * @inheritDoc
     */
    public function currencies()
    {
        try {
            $request = new SupportedCurrenciesRequest($this->apiKey);

            $response = $this->api->handle($request);

            $data = $this->getResponseData($response);

            return array_map(function (array $result) {
                return new Currency($result['id'], $result['currencyName'], $result['currencySymbol'] ?? null);
            }, $data['results']);
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function latest(string $base, $targets)
    {
        try {
            $request = new LatestExchangeRateRequest($this->apiKey, $base, $targets);

            $this->validate($request);

            $response = $this->api->handle($request);

            $data = $this->getResponseData($response);

            $exchangeRates = [];

            foreach ($data as $index => $value) {
                [$fromCurrency, $toCurrency] = explode('_', $index);

                $date = now()->toDateString();

                $exchangeRates[] = new ExchangeRate($fromCurrency, $toCurrency, $date, $value);
            }

            return $exchangeRates;
        } catch (ValidationException $e) {
            throw $e;
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function historical(string $base, $targets, string $date)
    {
        try {
            $request = new HistoricalExchangeRateRequest($this->apiKey, $base, $targets, $date);

            $this->validate($request);

            $response = $this->api->handle($request);

            $data = $this->getResponseData($response);

            $exchangeRates = [];

            foreach ($data as $index => $values) {
                [$fromCurrency, $toCurrency] = explode('_', $index);

                $exchangeRates[] = new ExchangeRate($fromCurrency, $toCurrency, $date, $values[$date]);
            }

            return $exchangeRates;
        } catch (ValidationException $e) {
            throw $e;
        } catch (RequestException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function timeSeries(string $base, $targets, string $startDate, string $endDate)
    {
        try {
            $request = new TimeSeriesExchangeRateRequest($this->apiKey, $base, $targets, $startDate, $endDate);

            $this->validate($request);

            $response = $this->api->handle($request);

            $data = $this->getResponseData($response);

            $exchangeRates = [];

            foreach ($data as $index => $values) {
                [$fromCurrency, $toCurrency] = explode('_', $index);

                foreach ($values as $date => $value) {
                    $exchangeRates[] = new ExchangeRate($fromCurrency, $toCurrency, $date, $value);
                }
            }

            return $exchangeRates;
        } catch (ValidationException $e) {
            throw $e;
        } catch (RequestException $e) {
            throw $e;
        }
    }
}
