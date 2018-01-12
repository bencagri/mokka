<?php

namespace Mokka\Action;


class Action
{
    protected $actionPrice;

    protected $previousPrice;

    protected $type;

    protected $symbol;

    protected $market;

    protected $lastUpdate;

    public function __construct($array = null)
    {
        $this->fromArray($array);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPreviousPrice()
    {
        return $this->previousPrice;
    }

    /**
     * @param mixed $price
     */
    public function setPreviousPrice($price)
    {
        $this->previousPrice = $price;
    }

    /**
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param mixed $symbol
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * @return mixed
     */
    public function getMarket()
    {
        return $this->market;
    }

    /**
     * @param mixed $market
     */
    public function setMarket($market)
    {
        $this->market = $market;
    }

    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * @param mixed $lastUpdate
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * @return mixed
     */
    public function getActionPrice()
    {
        return $this->actionPrice;
    }

    /**
     * @param mixed $actionPrice
     */
    public function setActionPrice($actionPrice)
    {
        $this->actionPrice = $actionPrice;
    }


    private function fromArray($array)
    {
        if(!is_null($array)){
            foreach ($array as $key => $item) {
                if(property_exists(Action::class,$key)){
                    $method = 'set'.ucfirst($key);
                    $this->$method($item);
                }
            }
        }
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}