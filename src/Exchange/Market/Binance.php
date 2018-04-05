<?php


namespace Mokka\Exchange\Market;

use GuzzleHttp\Client;
use Mokka\Action\BuyAction;
use Mokka\Action\SellAction;
use Mokka\Exchange\ExchangeInterface;

class Binance implements ExchangeInterface
{

    /**
     * @var
     */
    private static $apiService;

    public function __construct($config)
    {
        self::$apiService = new BinanceApiService($config['api_key'],$config['api_secret']);
    }

    /**
     * Get symbol price from source
     * @param $symbol
     * @return float
     */
    public function getPrice($symbol) : float
    {
        $client = new Client();

        $response = $client->get("https://api.binance.com/api/v3/ticker/price?symbol={$symbol}");

        $response = json_decode($response->getBody()->getContents(), TRUE);

        return (float) $response['price'];
    }

    /**
     * Get historical prices
     * @param $symbol
     * @return array
     */
    public function getHistoricalPrices($symbol): array
    {
        // TODO: Implement getHistoricalPrices() method.
    }

    /**
     * Put buy order
     * @param BuyAction $action
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function buyOrder(BuyAction $action)
    {

        $getServerTime = self::$apiService->getServerTime()->getBody()->getContents();
        $getServerTime = json_decode($getServerTime, true);

        $params = [
            'symbol' => $action->getSymbol(),
            'price' => $action->getActionPrice(),
            'quantity' => round($action->getQuantity(),2),
            'side'  => 'BUY',
            'type'  => 'LIMIT',
            'timeInForce' => 'GTC',
            'recvWindow' => 5000,
            'timestamp' => $getServerTime['serverTime']
        ];

        return self::$apiService->postOrderTest($params);
    }

    /**
     * Put sell order
     * @param SellAction $action
     * @return mixed
     */
    public function sellOrder(SellAction $action)
    {

        $getServerTime = self::$apiService->getServerTime()->getBody()->getContents();
        $getServerTime = json_decode($getServerTime, true);

        $params = [
            'symbol' => $action->getSymbol(),
            'price' => $action->getActionPrice(),
            'quantity' => $action->getQuantity(),
            'side'  => 'SELL',
            'type'  => 'LIMIT',
            'timeInForce' => 'GTC',
            'recvWindow' => 10000000,
            'timestamp' => $getServerTime['serverTime']

        ];

        return self::$apiService->postOrderTest($params);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'binance';
    }


}