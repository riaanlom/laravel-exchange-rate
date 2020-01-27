<?php

namespace Yoelpc4\LaravelExchangeRate\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        try {
            return $this->client->request($request->method(), $request->uri(), $request->options());
        } catch (GuzzleException $e) {
            throw $e;
        }
    }
}
