<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\Factories;

use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories\TimeSeriesRequestFactory as TimeSeriesRequestFactoryContract;
use Yoelpc4\LaravelExchangeRate\Requests\FreeCurrencyConverterApi\TimeSeriesRequest;

class TimeSeriesRequestFactory implements TimeSeriesRequestFactoryContract
{
    /**
     * @inheritDoc
     */
    public function make(string $base, $symbols, string $startDate, string $endDate)
    {
        $request = new TimeSeriesRequest($base, $symbols, $startDate, $endDate);

        try {
            $request->validator()->validate();
        } catch (ValidationException $e) {
            throw $e;
        }

        return $request;
    }
}
