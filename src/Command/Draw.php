<?php

namespace Jaunas\Chip8\Command;

use Jaunas\Chip8\DataType\GenericMemory;
use Jaunas\Chip8\DataType\Memory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class Draw extends Command
{

    /** @var Memory */
    private $memory;

    public function __construct(Memory $memory)
    {
        $this->memory = $memory;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Draw a sprite.')
            ->setName('draw')
            ->addArgument('file', InputArgument::REQUIRED, 'Path to file containing program.')
            ->addOption('index', null, InputOption::VALUE_REQUIRED, 'Index of sprite')
            ->addOption('height', null, InputOption::VALUE_REQUIRED, 'Height of sprite')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $program = GenericMemory::fromString(file_get_contents($input->getArgument('file')));
        $this->memory->loadProgram($program);

        $spriteData = $this->memory->getBlock($input->getOption('index'), $input->getOption('height'));

        for ($i=0; $i<$spriteData->getSize(); $i++) {
            $binary = decbin($spriteData[$i]);
            $padded = str_pad($binary, 8, '0', STR_PAD_LEFT);
            $replaced = str_replace(['0', '1'], ['  ', '██'], $padded);
            $output->writeln($replaced);
        }

        return 0;
    }
}
