<?php

namespace Mokka\Exchange;

use Mokka\Action\BuyAction;
use Mokka\Action\SellAction;

interface ExchangeInterface
{
    /**
     * Get symbol price from source
     * @param $symbol
     * @return float
     */
    public function getPrice($symbol) : float;

    /**
     * Get historical prices
     * @param $symbol
     * @return array
     */
    public function getHistoricalPrices($symbol) : array;

    /**
     * Put buy order
     * @param BuyAction $action
     * @return mixed
     */
    public function buyOrder(BuyAction $action);

    /**
     * Put sell order
     * @param SellAction $action
     * @return mixed
     */
    public function sellOrder(SellAction $action);

    public function getName();

}