<?php

namespace Yoelpc4\LaravelExchangeRate\Apis;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Yoelpc4\LaravelExchangeRate\Contracts\Apis\Api as ApiContract;
use Yoelpc4\LaravelExchangeRate\Contracts\Requests\Request;

class Api implements ApiContract
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Api constructor.
     *
     * @param  string  $baseUri
     */
    public function __construct(string $baseUri)
    {
        $this->client = new Client([
            'base_uri' => $baseUri,
        ]);
    }

    /**
     * @inheritDoc
     */
    public function handle(Request $request)
    {
        $options = [
            'query' => $request->query(),
        ];

        try {
            return $this->client->request($request->method(), $request->uri(), $options);
        } catch (RequestException $e) {
            throw $e;
        }
    }
}
