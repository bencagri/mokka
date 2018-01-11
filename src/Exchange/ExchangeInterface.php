<?php

namespace Mokka\Exchange;

interface ExchangeInterface
{
    /**
     * Get symbol price from source
     * @param $symbol
     * @return float
     */
    public function getPrice($symbol);

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

}