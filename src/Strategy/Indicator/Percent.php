<?php

namespace Mokka\Strategy\Indicator;

use Mokka\Action\Action;
use Mokka\Action\ActionInterface;
use Mokka\Action\BuyAction;
use Mokka\Action\IdleAction;
use Mokka\Action\SellAction;
use Mokka\Strategy\StrategyAbstract;
use Mokka\Strategy\IndicatorInterface;

class Percent extends StrategyAbstract implements IndicatorInterface
{

    const FIXER = 100000000;
    /**
     * @param $symbol
     * @param $lastAction Action last trade action
     * @return ActionInterface
     */
    public function calculate($symbol, Action $lastAction) : ActionInterface
    {
        //current price of symbol
        $currentPrice = $this->exchange->getPrice($symbol) * self::FIXER;

        $lastActionPrice = $lastAction->getActionPrice() * self::FIXER;

        //logic is here
        $calculatedPercentOfPrice = ($lastActionPrice * $this->options['default_percent']) / 100;


        //buy signal
        if (
            $lastAction->getType() == ActionInterface::TYPE_SELL
            &&
            $currentPrice <= $lastActionPrice - $calculatedPercentOfPrice
        ) {
            $action = new BuyAction();
            $action->setType(ActionInterface::TYPE_BUY);

        //sell signal
        } elseif (
            $lastAction->getType() == ActionInterface::TYPE_BUY
            &&
            $currentPrice >= $calculatedPercentOfPrice + $lastActionPrice
        ) {
            $action = new SellAction();
            $action->setType(ActionInterface::TYPE_SELL);
        } else {
            $action = new IdleAction();
            $action->setType(ActionInterface::TYPE_IDLE);
        }

        $lastActionPrice = number_format($lastActionPrice / self::FIXER, 8, '.', '');
        $currentPrice = number_format($currentPrice / self::FIXER, 8, '.', '');

        $action->setPreviousPrice($lastActionPrice);
        $action->setActionPrice($currentPrice);

        return $action;

    }

}