<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts\Factories;

use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Requests\Contracts\LatestRequest;

interface LatestRequestFactory
{
    /**
     * Create a new latest request instance.
     *
     * @param  string  $base
     * @param  mixed  $symbols
     * @return LatestRequest
     * @throws ValidationException
     */
    public function make(string $base, $symbols);
}
