<?php
namespace Mokka\Strategy;

use Mokka\Action\Action;
use Mokka\Action\ActionInterface;

interface IndicatorInterface
{
    /**
     * Indicator Calculator
     * @param $symbol
     * @param $lastAction Action
     * @return ActionInterface
     */
    public function calculate($symbol, Action $lastAction): ActionInterface;
}