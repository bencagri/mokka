Parameters
------------
You can use parameters below for **Mokka**


    
|    name     |description | required  | default  | 
|-------------|------------|-----------|----------|
|`--market`   | the market that you can choose |  no  |  binance  |   
|`--interval` | the period (as seconds) of making requests | no  |  60  |   
|`--symbol`   | Botta will check the strategy and prices for this symbol. ie. ETHBTC  | yes  |  - |  
|`--test`     | You may want to use Botta in test mode. if set `True`, botta will work without making trading | no  |  false |  


Example;

`` bin/mokka run --symbol=ETHBTC --interval=120 --test=true``

this command will check ETHBTC symbol's price on every 2 minutes (120 seconds) and work in test mode. you will see only signals before trading.

#### Next
Check [the reports](03-reports.md) that you can use with command.