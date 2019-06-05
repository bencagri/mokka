<?php

namespace Mokka\Calculator;

class Quantity
{

    public function buyQuantityCalculator($maxFund, $price, $balance)
    {
        //calculate max fund based balance
        if ($maxFund > 100) {
            throw new \InvalidArgumentException('max_fund value can not be more than 100');
        }
        if ($maxFund < 1) {
            throw new \InvalidArgumentException('max_fund value can not be less than 1');
        }

        $buyFund = ($balance * $maxFund) / 100;
        return round($buyFund / $price, 8);
    }

    public function sellQuantityCalculator($maxSell, $price)
    {
        return ($maxSell / 100) * $price;
    }
}