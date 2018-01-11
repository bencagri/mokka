<?php


namespace Mokka\Exchange\Market;

use Botta\Exchange\ExchangeInterface;

class Binance implements ExchangeInterface
{

    /**
     * @var
     */
    private $apiService;

    public function __construct($config)
    {
        $this->apiService = new BinanceApiService($config['api_key'],$config['api_secret']);
    }

    /**
     * Get symbol price from source
     * @param $symbol
     * @return mixed
     */
    public function getPrice($symbol)
    {
        exit(1);
//        var_dump($this->apiService->ping()->getBody()->getContents());
//        $response =  $this->apiService->getSymbolPrice($symbol);
//        dump($response);
    }

    /**
     * Put buy order
     * @return mixed
     */
    public function buyOrder()
    {
        // TODO: Implement buyOrder() method.
    }

    /**
     * Put sell order
     * @return mixed
     */
    public function sellOrder()
    {
        // TODO: Implement sellOrder() method.
    }
}