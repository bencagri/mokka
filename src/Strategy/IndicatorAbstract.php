<?php


namespace Mokka\Strategy;


use Mokka\Exchange\ExchangeInterface;

class IndicatorAbstract
{

    /**
     * @var ExchangeInterface
     */
    protected $exchange;
    protected $options;

    public function __construct(ExchangeInterface $exchange, $options)
    {

        $this->exchange = $exchange;
        $this->options = $options;
    }
}