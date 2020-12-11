<?php

namespace Yoelpc4\LaravelExchangeRate;

use Illuminate\Validation\ValidationException;
use Psr\Http\Client\ClientExceptionInterface;
use Yoelpc4\LaravelExchangeRate\Concerns\Response;
use Yoelpc4\LaravelExchangeRate\Concerns\Validation;
use Yoelpc4\LaravelExchangeRate\Contracts\Api\Api;
use Yoelpc4\LaravelExchangeRate\Contracts\ExchangeRateProvider;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\HistoricalExchangeRate;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\HistoricalExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\LatestExchangeRate;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\LatestExchangeRateRequest;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\SupportedCurrencies;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\SupportedCurrenciesRequest;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\TimeSeriesExchangeRate;
use Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi\TimeSeriesExchangeRateRequest;

class FreeCurrencyConverterApi implements ExchangeRateProvider
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
     * FreeCurrencyConverterApi constructor.
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
        $request = new SupportedCurrenciesRequest($this->apiKey);

        try {
            $response = $this->api->handle($request);
        } catch (ClientExceptionInterface $e) {
            throw $e;
        }

        $data = $this->getResponseData($response);

        return new SupportedCurrencies($data);
    }

    /**
     * @inheritDoc
     */
    public function latest(string $base, $targets)
    {
        $request = new LatestExchangeRateRequest($this->apiKey, $base, $targets);

        try {
            $this->validate($request);
        } catch (ValidationException $e) {
            throw $e;
        }

        try {
            $response = $this->api->handle($request);
        } catch (ClientExceptionInterface $e) {
            throw $e;
        }

        $data = $this->getResponseData($response);

        return new LatestExchangeRate($base, $targets, $data);
    }

    /**
     * @inheritDoc
     */
    public function historical(string $base, $targets, string $date)
    {
        $request = new HistoricalExchangeRateRequest($this->apiKey, $base, $targets, $date);

        try {
            $this->validate($request);
        } catch (ValidationException $e) {
            throw $e;
        }

        try {
            $response = $this->api->handle($request);
        } catch (ClientExceptionInterface $e) {
            throw $e;
        }

        $data = $this->getResponseData($response);

        return new HistoricalExchangeRate($base, $targets, $date, $data);
    }

    /**
     * @inheritDoc
     */
    public function timeSeries(string $base, $targets, string $startDate, string $endDate)
    {
        $request = new TimeSeriesExchangeRateRequest($this->apiKey, $base, $targets, $startDate, $endDate);

        try {
            $this->validate($request);
        } catch (ValidationException $e) {
            throw $e;
        }

        try {
            $response = $this->api->handle($request);
        } catch (ClientExceptionInterface $e) {
            throw $e;
        }

        $data = $this->getResponseData($response);

        return new TimeSeriesExchangeRate($base, $targets, $startDate, $endDate, $data);
    }
}
