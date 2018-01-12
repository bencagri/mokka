<?php

namespace Mokka\Action;


interface ActionInterface
{
    const TYPE_BUY = 'buy';
    const TYPE_SELL = 'sell';
    const TYPE_IDLE = 'idle';

    public function setActionPrice($price);
    public function setType($type);
    public function setPreviousPrice($previousPrice);

    public function getType();
    public function getActionPrice();
    public function getPreviousPrice();
}