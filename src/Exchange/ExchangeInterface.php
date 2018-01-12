<?php

namespace Mokka\Exchange;

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
     * @return mixed
     */
    public function buyOrder();

    /**
     * Put sell order
     * @return mixed
     */
    public function sellOrder();

    public function getName();

}