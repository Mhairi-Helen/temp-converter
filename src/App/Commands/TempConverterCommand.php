<?php
namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class HelloWorld
 *
 * @package App\Command
 */
class TempConverterCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('app:convert-temp')
            ->setDescription('Converts temperature from Fahrenheit to Celsius and back')
            ->setHelp('Input temperature then unit of measure when calling the command')
            ->addArgument('value', InputArgument::REQUIRED, 'Temperature value to be converted')
            ->addArgument('unit', InputArgument::REQUIRED, 'Unit of temperature to be converted');
    }

    protected function execute(InputInterface $input, OutputInterface $output): float|int
    {
        $tempValue = $input->getArgument('value');
        var_dump($tempValue);
        $tempUnit = $input->getArgument('unit');
        var_dump($tempUnit);
        $convertedTempValue = null;

        var_dump($tempUnit != "Celsius");
        var_dump($tempUnit != "Fahrenheit");

        if (!is_numeric($tempValue)) {

            $returnMessage = 'The Temp Value input must be an number';

        } elseif (($tempUnit != "Celsius") && ($tempUnit != "Fahrenheit")) {

            $returnMessage = 'Sorry, the unit must either be Fahrenheit or Celsius';

        } elseif ($tempUnit === "Fahrenheit") {

            $convertedTempValue = round(($tempValue - 32)*5/9, PHP_ROUND_HALF_UP);

            $returnMessage = "The temperature is ".$convertedTempValue." Celsius";

        } else {

            $convertedTempValue = round($tempValue*9/5+32, PHP_ROUND_HALF_UP);

            $returnMessage = "The temperature is ".$convertedTempValue." Fahrenheit";
        }

        $output->writeln($returnMessage);

        return Command::SUCCESS;
    }
}