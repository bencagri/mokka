<?php

namespace Mokka\Exchange\Market;


use Larislackers\BinanceApi\BinanceApiContainer;

class BinanceApiService extends BinanceApiContainer
{

    public function getSymbolPrice($symbol)
    {
        $params['symbol'] = $symbol;
        dump($params);
        return $this->_makeApiRequest('GET', 'ticker/price', 'SIGNED');
    }

}