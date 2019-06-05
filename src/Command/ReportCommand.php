<?php

namespace Mokka\Command;

use Mokka\Config\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;


class ReportCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('report')
            ->setDescription('Generate mokka reports')
            ->addOption('market', 'm', InputOption::VALUE_OPTIONAL, 'Choose market to run')
            ->addOption('symbol', 's', InputOption::VALUE_OPTIONAL, 'Specific symbol for the report')
            ->addOption('date', 'd', InputOption::VALUE_OPTIONAL, 'Choose the date of repor. Format: YYYY-MM-DD')
            ->addOption('format', 'f', InputOption::VALUE_OPTIONAL, 'File format for the reports. Default is console output. Available formats; CSV, XML, JSON', "console")
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $fs = new Filesystem();
            if (!is_dir(__DIR__.'/../../reports')) $fs->mkdir(__DIR__.'/../../reports');

            $reportDate = $input->getOption("date") ? $input->getOption("date") : (new \DateTime())->format('Y-m-d');

            //set logs (txt db)
            $logger = new Logger(__DIR__.'/../../logs/', $reportDate);

            $report = $logger->read();

            if ($input->getOption("symbol")) {
                $report->where("symbol", "=", $input->getOption("symbol"));
            }

            if ($input->getOption("market")) {
                $report->where("market", "=", $input->getOption("market"));
            }

            $reportData = $report->get();

            $formatData = [];

            array_map(function($row) use (&$formatData){
                $row['lastUpdate'] = date('Y-m-d H:i:s', $row['lastUpdate']);
                $formatData[] = $row;
            }, (array) $reportData->getIterator());

            $format = $input->getOption("format");
            $method = "output".ucfirst($format);

            if (method_exists($this, $method)) {
                $this->$method($input, $output, $formatData);
            }

        } catch (\Exception $exception) {
            $output->writeln("<error>{$exception->getMessage()}</error>");
        }
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param $reportData
     */
    protected function outputConsole(InputInterface $input, OutputInterface  $output, $reportData)
    {
        $table = new Table($output);
        $table->setHeaders(array('Action Price', 'Previous Price', 'Action', 'Symbol', 'Market', 'Update Date'));

        $table->setRows($reportData);

        $table->render();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param $reportData
     */
    protected function outputJson(InputInterface $input, OutputInterface  $output, $reportData) {
        $fs = new Filesystem();

        $fileName = "report_".time().".json";
        $filePath = __DIR__."/../../reports/".$fileName;

        $fs->dumpFile($filePath, json_encode($reportData));

        $realPath = realpath(dirname($filePath))."/".$fileName;
        $output->writeln("<question>Report Generated!</question>");
        $output->writeln("<question>{$realPath}</question>");

    }

}