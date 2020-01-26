<?php

namespace Yoelpc4\LaravelExchangeRate\ExchangeRates;

class Currency
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $symbol;

    /**
     * Currency constructor.
     *
     * @param  string  $name
     * @param  string  $symbol
     */
    public function __construct(string $name, string $symbol)
    {
        $this->name = $name;
        $this->symbol = $symbol;
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
     * @return string
     */
    public function symbol()
    {
        return $this->symbol;
    }
}
