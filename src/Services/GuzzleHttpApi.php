<?php

namespace Yoelpc4\LaravelExchangeRate\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Request;
use Yoelpc4\LaravelExchangeRate\Services\Contracts\Api;

class GuzzleHttpApi implements Api
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * GuzzleHttpApi constructor.
     *
     * @param  array  $config
     */
    public function __construct(array $config)
    {
        $this->client = new Client($config);
    }

    /**
     * Perform get request to the specified endpoint
     *
     * @param  Request  $request
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get(Request $request)
    {
        $options = [
            'query' => $request->queryParams(),
        ];

        try {
            return $this->client->request('GET', $request->uri(), $options);
        } catch (GuzzleException $e) {
            throw $e;
        }
    }
}
