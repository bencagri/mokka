Installation
------------
To install and use **Mokka**, first, you will need;

* PHP 7.1
* Composer [(how to install?)](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
* Git (optional) [(how to install?)](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

Then, (if git is installed) open terminal and type;
```bash
$ git clone https://github.com/bencagri/mokka.git
$ cd mokka
$ composer install
```

or [Download](https://github.com/bencagri/mokka/archive/master.zip) the repo. Unzip it, and locate the directory in terminal;

```bash
$ cd mokka
$ composer install
```
Mokka is being installed now. 

> You will need to add your binance api key and api secret. To create Api Key and Secret Follow these 
> [intructions](https://coinigy.freshdesk.com/support/solutions/articles/1000256048-how-do-i-find-my-api-key-on-binance-com-).


Then go to *config* directory and open *mokka.yml* file


```$xslt
markets:
    binance:
      api_key: YOUR_API_KEY
      api_secret: YOUR_API_SECRET

```

Everything seems ready.

Now we can run the **Mokka** and lean back. :)

```bash
$ bin/mokka run --symbol=BTCUSD --interval=90
```

#### Next
Check [the parameters](02-parameters.md) that you can use with command.

