<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Factories;

use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\HistoricalRequestFactory as HistoricalRequestFactoryContract;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\HistoricalRequest;

class HistoricalRequestFactory implements HistoricalRequestFactoryContract
{
    /**
     * @inheritDoc
     */
    public function make(string $base, $symbols, string $date)
    {
        $request = new HistoricalRequest($base, $symbols, $date);

        try {
            $request->validator()->validate();
        } catch (ValidationException $e) {
            throw $e;
        }

        return $request;
    }
}
