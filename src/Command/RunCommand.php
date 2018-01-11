<?php

namespace Mokka\Command;


use Botta\Config\Configurator;

use Botta\Exchange\ExchangeFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class RunCommand extends Command
{

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('run')
            ->setDescription('Run Botta! Run!')
            ->addOption('market','m',InputOption::VALUE_OPTIONAL,'Choose market to run','binance')
            ->addOption('interval','i',InputOption::VALUE_OPTIONAL,'Seconds for each requests. Default: 60',60)
            ->addOption('symbol','s',InputOption::VALUE_OPTIONAL,'Symbol for the bot to run','BTCUSDT')
            ->addOption('test','t',InputOption::VALUE_OPTIONAL,'Test mode for botta. If set TRUE botta will not buy and sell any crypto currency',false)

        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //get config first
        try {

            $config = (new Configurator(__DIR__ . '/../../config'))->make();

            $interval  = $input->getOption('interval');

            //check if Exchange Market provider is available
            $marketConfig = $config->get('markets.'.  $input->getOption('market'));
            $market = (new ExchangeFactory($input->getOption('market')))->make([$marketConfig]);

            //get symbols's current price from exchange market

            //get last action

            //run the strategy

            //if strategy returns do buy or sell action based on last action


            $output->writeln('It Works!');

        }catch (InvalidArgumentException $exception){

        }
    }


}