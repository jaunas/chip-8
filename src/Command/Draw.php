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
            ->addOption('metadata', null, InputOption::VALUE_OPTIONAL, 'Path to metadata file in json format.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $program = GenericMemory::fromString(file_get_contents($input->getArgument('file')));
        $this->memory->loadProgram($program);

        $sprites = $this->getSpriteBlocks($input);

        foreach ($sprites as $sprite) {
            $output->writeln(sprintf('Sprite at index %s, height %s', $sprite['index'], $sprite['height']));
            $output->writeln($this->getSpriteString($sprite));
            $output->writeln('');
        }

        return 0;
    }

    private function getSpriteBlocks(InputInterface $input): array
    {
        if (($metaFile = $input->getOption('metadata')) !== null) {
            return json_decode(file_get_contents($metaFile), true)['sprites'];
        }

        return [[
            'index' => $input->getOption('index'),
            'height' => $input->getOption('height')
        ]];
    }

    private function getSpriteString(array $sprite): string
    {
        $spriteData = $this->memory->getBlock($sprite['index'], $sprite['height']);

        $string = "┌────────────────┐\n";
        for ($i = 0; $i< $spriteData->getSize(); $i++) {
            $binary = decbin($spriteData[$i]);
            $padded = str_pad($binary, 8, '0', STR_PAD_LEFT);
            $replaced = str_replace(['0', '1'], ['  ', '██'], $padded);

            $string .= '│' . $replaced . "│\n";
        }

        $string .= '└────────────────┘';

        return $string;
    }
}
