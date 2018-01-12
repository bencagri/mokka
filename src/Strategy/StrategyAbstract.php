<?php

namespace Mokka\Strategy;

use Mokka\Config\Logger;
use Mokka\Exchange\ExchangeInterface;

abstract class StrategyAbstract
{

    /**
     * @var ExchangeInterface
     */
    protected $exchange;
    protected $options;
    protected $logger;

    public function __construct(
        ExchangeInterface $exchange,
        Logger $logger,
        $options
    )
    {
        $this->exchange = $exchange;
        $this->logger = $logger;
        $this->options = $options;
    }
}