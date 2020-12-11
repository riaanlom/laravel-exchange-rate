<?php

namespace Yoelpc4\LaravelExchangeRate\FreeCurrencyConverterApi;

use Yoelpc4\LaravelExchangeRate\Contracts\CurrencyInterface;

class Currency implements CurrencyInterface
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
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->code = $data['id'];

        $this->name = $data['currencyName'];

        $this->symbol = $data['currencySymbol'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function code()
    {
        return $this->code;
    }

    /**
     * @inheritDoc
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function symbol()
    {
        return $this->symbol;
    }
}
