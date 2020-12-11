<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts;

interface Validatable
{
    /**
     * Get validatable data
     *
     * @return array
     */
    public function data();

    /**
     * Get validatable rules
     *
     * @return array
     */
    public function rules();

    /**
     * Get validatable messages
     *
     * @return array
     */
    public function messages();

    /**
     * Get validatable custom attributes
     *
     * @return array
     */
    public function customAttributes();
}
