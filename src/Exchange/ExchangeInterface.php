<?php

namespace Mokka\Exchange;

interface ExchangeInterface
{
    /**
     * Get symbol price from source
     * @param $symbol
     * @return float
     */
    public static function getPrice($symbol) : float;

    /**
     * Put buy order
     * @return mixed
     */
    public static function buyOrder();

    /**
     * Put sell order
     * @return mixed
     */
    public static function sellOrder();

}