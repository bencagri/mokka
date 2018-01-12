<?php

namespace Mokka\Strategy;


use Flatbase\Flatbase;
use Mokka\Config\Action;
use Mokka\Exchange\ExchangeInterface;

class StrategyCalculator
{

    /**
     * @var ExchangeInterface
     */
    private static $exchange;
    /**
     * @var IndicatorInterface
     */
    private static $indicator;

    /**
     * @var Action
     */
    private static $action;
    /**
     * @var Flatbase
     */
    private static $database;

    /**
     * @var
     */
    private $symbol;

    /**
     * @var
     */
    private $interval;

    private static $dbName;

    /**
     * StrategyCalculator constructor.
     * @param ExchangeInterface $exchange
     * @param IndicatorInterface $indicator
     * @param Action $action
     * @param Flatbase $database
     */
    public function __construct(
        ExchangeInterface $exchange,
        IndicatorInterface $indicator,
        Action $action,
        Flatbase $database
    )
    {
        self::$exchange = $exchange;
        self::$indicator = $indicator;
        self::$action = $action;
        self::$database = $database;

        self::$dbName = (new \DateTime())->format('Y-m-d');

    }


    public function run()
    {
        //calculate in loop by interval
        self::$indicator->calculate($this->getSymbol());
    }

    /**
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param mixed $symbol
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * @return mixed
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param mixed $interval
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
    }

}