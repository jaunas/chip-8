<?php

namespace Jaunas\Chip8\Command;

use Jaunas\Chip8\Emulator;
use Jaunas\Chip8\Terminal;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Test extends Command
{
    protected function configure()
    {
        $this
            ->setDescription('Test command.')
            ->setName('test')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Jestę programę');

        return 0;
    }
}