<?php

namespace Jaunas\Chip8\Command;

use Jaunas\Chip8\Emulator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Run
 */
class Run extends Command
{
    protected function configure()
    {
        $this
            ->setDescription('Runs an application in the emulator.')
            ->setName('run')
            ->addArgument('file', InputArgument::REQUIRED, 'Path to file containing program.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $emulator = new Emulator();
        $emulator->loadProgramFromFile($input->getArgument('file'));
        $emulator->run();

        return 0;
    }
}