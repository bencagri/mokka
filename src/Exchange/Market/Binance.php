<?php


namespace Mokka\Exchange\Market;

use GuzzleHttp\Client;
use Mokka\Exchange\ExchangeInterface;

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
     * @return float
     */
    public static function getPrice($symbol) : float
    {
        $client = new Client();

        $request = $client->get("https://api.binance.com/api/v3/ticker/price?symbol={$symbol}");

        $response = json_decode($request->getBody()->getContents(), TRUE);

        return (float) $response['price'];
    }

    /**
     * Put buy order
     * @return mixed
     */
    public static function buyOrder()
    {
        // TODO: Implement buyOrder() method.
    }

    /**
     * Put sell order
     * @return mixed
     */
    public static function sellOrder()
    {
        // TODO: Implement sellOrder() method.
    }
}