<?php

namespace Yoelpc4\LaravelExchangeRate\Services\FreeCurrencyConverterApi;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Yoelpc4\LaravelExchangeRate\Exceptions\HistoricalExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\LatestExchangeRateException;
use Yoelpc4\LaravelExchangeRate\Exceptions\TimeSeriesExchangeRateException;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\HistoricalExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\LatestExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\ExchangeRates\Contracts\Factories\TimeSeriesExchangeRateFactory;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\HistoricalRequest;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\LatestRequest;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\TimeSeriesRequest;
use Yoelpc4\LaravelExchangeRate\Services\Api;
use Yoelpc4\LaravelExchangeRate\Services\Contracts\ExchangeRateService;

class Service implements ExchangeRateService
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var Api
     */
    protected $api;

    /**
     * Service constructor.
     */
    public function __construct()
    {
        $this->api = new Api([
            'base_uri' => \Config::get('exchange-rate.services.free_currency_converter_api.base_url'),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function latest(LatestRequest $request)
    {
        try {
            $response = $this->api->get($request);

            $statusCode = $response->getStatusCode();

            $contents = $response->getBody()->getContents();

            if ($statusCode !== Response::HTTP_OK) {
                throw new LatestExchangeRateException($contents, $statusCode);
            }

            return \App::make(LatestExchangeRateFactory::class)->make($request, $contents);

        } catch (GuzzleException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function historical(HistoricalRequest $request)
    {
        try {
            $response = $this->api->get($request);

            $statusCode = $response->getStatusCode();

            $contents = $response->getBody()->getContents();

            if ($statusCode !== Response::HTTP_OK) {
                throw new HistoricalExchangeRateException($contents, $statusCode);
            }

            return \App::make(HistoricalExchangeRateFactory::class)->make($request, $contents);
        } catch (GuzzleException $e) {
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    public function timeSeries(TimeSeriesRequest $request)
    {
        try {
            $response = $this->api->get($request);

            $statusCode = $response->getStatusCode();

            $contents = $response->getBody()->getContents();

            if ($statusCode !== Response::HTTP_OK) {
                throw new TimeSeriesExchangeRateException($contents, $statusCode);
            }

            return \App::make(TimeSeriesExchangeRateFactory::class)->make($request, $contents);
        } catch (GuzzleException $e) {
            throw $e;
        }
    }
}
