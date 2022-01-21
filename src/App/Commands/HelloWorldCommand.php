<?php
namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class HelloWorld
 *
 * @package App\Command
 */
class HelloWorldCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:hello-world')
            ->setDescription('Outputs "Hello World"');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $output->writeln("Hello World");

        return Command::SUCCESS;
    }
}