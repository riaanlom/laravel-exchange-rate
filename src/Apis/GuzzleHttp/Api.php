<?php

namespace Yoelpc4\LaravelExchangeRate\Apis\GuzzleHttp;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Yoelpc4\LaravelExchangeRate\Contracts\Api\ApiInterface;
use Yoelpc4\LaravelExchangeRate\Contracts\Base\BaseRequestInterface;

class Api implements ApiInterface
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
    public function handle(BaseRequestInterface $request)
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
