<?php

namespace App\Command;

use App\Service\WeatherUtil;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LocationCommand extends Command
{
    private WeatherUtil $weatherUtil;
    protected static $defaultName = 'LocationCommand';
    protected static $defaultDescription = 'Get a location!';

    public function __construct(WeatherUtil $weatherUtil)
    {
        $this->weatherUtil = $weatherUtil;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('id', null, InputOption::VALUE_REQUIRED, 'ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $id = $input->getArgument('id');

        if (!$id) {
            $io->note(sprintf('ID not passed'));
        }

        $id =  intval($id) ?? null;
        if (!$id) {
            $io->error('ID not a number');
            return -1;
        }

        $results = $this->weatherUtil->getWeatherForLocation($id);
        if (count($results) == 0) {
            $io->error("No results");
            return -1;
        }

        $data = array();
        foreach ($results as $result) {
            $returnObj = [
                'id' => $result->getId(),
                'humidity' => $result->getHumidity(),
                'conditions' => $result->getConditions(),
                'windVelocity' => $result->getWindVelocity(),
                'temperature' => $result->getTemperature(),
            ];
            array_push($data, $returnObj);
        }

        $output->writeln(json_encode($data));

        $io->success('Command run successfully!');

        return Command::SUCCESS;
    }
}
