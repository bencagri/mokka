<?php


namespace Mokka\Action;


class BuyAction extends Action implements ActionInterface
{

    /** @var  double Amount to buy */
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