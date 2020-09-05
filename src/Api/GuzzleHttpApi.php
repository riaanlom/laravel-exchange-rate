<?php

namespace Yoelpc4\LaravelExchangeRate\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Yoelpc4\LaravelExchangeRate\Contracts\Api\Api;
use Yoelpc4\LaravelExchangeRate\Contracts\Requestable;

class GuzzleHttpApi implements Api
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * GuzzleHttpApi constructor.
     *
     * @param  string  $baseUrl
     */
    public function __construct(string $baseUrl)
    {
        $this->client = new Client([
            'base_uri' => $baseUrl,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function handle(Requestable $requestable)
    {
        $options = [
            'query' => $requestable->query(),
        ];

        try {
            return $this->client->request($requestable->method(), $requestable->endpoint(), $options);
        } catch (RequestException $e) {
            throw $e;
        }
    }
}
