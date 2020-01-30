<?php

namespace Yoelpc4\LaravelExchangeRate\Contracts\Requests;

interface MustValidated
{
    /**
     * Get must validated's data for validation
     *
     * @return array
     */
    public function data();

    /**
     * Get must validated's rules for validation
     *
     * @return array
     */
    public function rules();

    /**
     * Get must validated's messages for validation
     *
     * @return array
     */
    public function messages();

    /**
     * Get must validated's custom attributes for validation
     *
     * @return array
     */
    public function customAttributes();
}
