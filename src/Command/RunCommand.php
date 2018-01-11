<?php

namespace Mokka\Command;


use Mokka\Config\Action;
use Mokka\Config\Configurator;
use Mokka\Exchange\ExchangeFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;


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

            $helper = $this->getHelper('question');

            $config = (new Configurator(__DIR__ . '/../../config'))->make();


            $interval  = $input->getOption('interval');

            //check if Exchange Market provider is available
            $marketConfig = $config->get('markets.'.  $input->getOption('market'));
            $market = (new ExchangeFactory($input->getOption('market')))->make([$marketConfig]);

            //get symbols's current price from exchange market
            $price = $market::getPrice($input->getOption('symbol'));

            //get last action
            $action = new Action(__DIR__ . '/../../logs');

            $lastAction = $action->read();

            if (!$lastAction){
               $lastAction = $this->createActionFile($action, $helper, $input, $output, $price);
            }

            //run the strategy

            //if strategy returns do buy or sell action based on last action


            $output->writeln('It Works!');

        }catch (InvalidArgumentException $exception){

        }
    }

    /**
     * @param Action $action
     * @param Helper $helper
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return array
     */
    protected function createActionFile(Action $action, Helper $helper, InputInterface $input, OutputInterface $output, $price)
    {

        $question = new ChoiceQuestion(
            'We need to know your first transaction. What do you want to do first?',
            array('buy', 'sell'),
            0
        );

        $question->setErrorMessage('Your response is invalid.');
        $choosenAction = $helper->ask($input, $output, $question);

        $actionContent = [
            'last'=> $action->viceVersa($choosenAction),
            'price' => $price
        ];
        $output->writeln("<info>OK. I will {$choosenAction} {$input->getOption('symbol')} first.</info>");
        $action->write($actionContent);


        return $actionContent;
    }


}