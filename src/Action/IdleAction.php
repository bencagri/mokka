<?php

namespace Mokka\Action;

class IdleAction extends Action implements ActionInterface
{

    protected $quantity = 0;

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }
}