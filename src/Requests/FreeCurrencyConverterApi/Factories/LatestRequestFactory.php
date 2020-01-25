<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Factories;

use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\LatestRequestFactory as LatestRequestFactoryContract;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\LatestRequest;

class LatestRequestFactory implements LatestRequestFactoryContract
{
    /**
     * @inheritDoc
     */
    public function make(string $base, $symbols)
    {
        $request = new LatestRequest($base, $symbols);

        try {
            $request->validator()->validate();
        } catch (ValidationException $e) {
            throw $e;
        }

        return $request;
    }
}
