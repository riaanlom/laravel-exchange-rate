<?php

namespace Yoelpc4\LaravelExchangeRate\Requests\Contracts;

interface MustValidated
{
    /**
     * Get handle's data for validation
     *
     * @return array
     */
    public function data();

    /**
     * Get handle's rules for validation
     *
     * @return array
     */
    public function rules();

    /**
     * Get handle's messages for validation
     *
     * @return array
     */
    public function messages();

    /**
     * Get handle's custom attributes for validation
     *
     * @return array
     */
    public function customAttributes();
}
