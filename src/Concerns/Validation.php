<?php

namespace Yoelpc4\LaravelExchangeRate\Concerns;

use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Contracts\Validatable;

trait Validation
{
    /**
     * Validate the request
     *
     * @param  Validatable  $request
     * @throws ValidationException
     */
    protected function validate(Validatable $request)
    {
        try {
            validator($request->data(), $request->rules(), $request->messages(), $request->customAttributes())->validate();
        } catch (ValidationException $e) {
            throw $e;
        }
    }
}
