<?php

namespace Yoelpc4\LaravelExchangeRate;

class Currency
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $symbol;

    /**
     * Currency constructor.
     *
     * @param  string  $code
     * @param  string  $name
     * @param  string|null  $symbol
     */
    public function __construct(string $code, string $name, string $symbol = null)
    {
        $this->code = $code;

        $this->name = $name;

        $this->symbol = $symbol;
    }

    /**
     * Get currency's code
     *
     * @return string
     */
    public function code()
    {
        return $this->code;
    }

    /**
     * Get currency's name
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Get currency's symbol
     *
     * @return string|null
     */
    public function symbol()
    {
        return $this->symbol;
    }
}
