<?php

namespace Mokka\Action;

class SellAction extends Action implements ActionInterface
{

    /** @var  double Quantity to sell */
    protected $quantity;

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity(float $quantity)
    {
        $this->quantity = $quantity;
    }

}