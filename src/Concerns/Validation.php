<?php

namespace Yoelpc4\LaravelExchangeRate\Concerns;

use Illuminate\Validation\ValidationException;
use Yoelpc4\LaravelExchangeRate\Contracts\Validatable;

trait Validation
{
    /**
     * Do a validation
     *
     * @param  Validatable  $validateable
     * @throws ValidationException
     */
    protected function validate(Validatable $validateable)
    {
        try {
            validator($validateable->data(), $validateable->rules(), $validateable->messages(),
                $validateable->customAttributes())
                ->validate();
        } catch (ValidationException $e) {
            throw $e;
        }
    }
}
