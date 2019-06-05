<?php

namespace Mokka\Strategy;


use DoctrineTest\InstantiatorTestAsset\AbstractClassAsset;
use Mokka\Action\Action;
use Mokka\Action\ActionInterface;
use Mokka\Action\BuyAction;
use Mokka\Action\IdleAction;
use Mokka\Action\SellAction;
use Mokka\Config\Logger;
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
     * @var
     */
    private $symbol;

    /**
     * @var
     */
    private $interval;

    /**
     * @var
     */
    private $market;
    /**
     * StrategyCalculator constructor.
     * @param ExchangeInterface $exchange
     * @param IndicatorInterface $indicator
     */
    public function __construct(
        ExchangeInterface $exchange,
        IndicatorInterface $indicator
    )
    {
        self::$exchange = $exchange;
        self::$indicator = $indicator;

    }

    public function run(Logger $logger): Action
    {
        //get last action and price from logs
        $lastAction = $logger
            ->read()
            ->where('market', '=', $this->getMarket())
            ->where('symbol', '=', $this->getSymbol())
            ->sortDesc('lastUpdate')
            ->limit(1)
            ->first();

        $lastAction = new Action($lastAction);

        //calculate in loop by interval
        /** @var ActionInterface $actionType */
        $actionType = self::$indicator->calculate($this->getSymbol(), $lastAction);

        if ($actionType->getType() == ActionInterface::TYPE_BUY) {
            $action = new BuyAction();
        }elseif ($actionType->getType() == ActionInterface::TYPE_SELL) {
            $action = new SellAction();
        }elseif ($actionType->getType() == ActionInterface::TYPE_IDLE) {
            $action = new IdleAction();
        }

        /** @var ActionInterface $action */
        $action->setType($actionType->getType());
        $action->setSymbol($this->getSymbol());
        $action->setMarket($this->getMarket());
        $action->setPreviousPrice($lastAction->getActionPrice());
        $action->setActionPrice($actionType->getActionPrice());
        $action->setLastUpdate(time());

        return $action;
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

    /**
     * @return mixed
     */
    public function getMarket()
    {
        return $this->market;
    }

    /**
     * @param mixed $market
     */
    public function setMarket($market)
    {
        $this->market = $market;
    }

}