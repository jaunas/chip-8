<?php

namespace Jaunas\Chip8\Command;

use Jaunas\Chip8\DataType\GenericMemory;
use Jaunas\Chip8\DataType\Memory;
use Jaunas\Chip8\Exception\UnknownOpcode;
use Jaunas\Chip8\Work\Dispatcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class Translate extends Command
{

    /** @var Memory */
    private $memory;

    /** @var Dispatcher */
    private $dispatcher;

    public function __construct(Memory $memory, Dispatcher $dispatcher)
    {
        $this->memory = $memory;
        $this->dispatcher = $dispatcher;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Translate to pseudocode.')
            ->setName('translate')
            ->addArgument('file', InputArgument::REQUIRED, 'Path to file containing program.')
            ->addOption('metadata', null, InputOption::VALUE_OPTIONAL, 'Path to metadata file in json format.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $program = GenericMemory::fromString(file_get_contents($input->getArgument('file')));
        $this->memory->loadProgram($program);

        $code = $this->getCodeBlocks($input, $program->getSize());

        foreach ($code as $block) {
            $output->writeln(sprintf('Block %s - %s', $block['begin'], $block['end']));

            for ($programCounter = $block['begin']; $programCounter <= $block['end']; $programCounter += 2) {
                $output->writeln($this->translateOpcode($programCounter));
            }

            $output->writeln('');
        }

        return 0;
    }

    private function getCodeBlocks(InputInterface $input, int $size): array
    {
        if (($metaFile = $input->getOption('metadata')) !== null) {
            return json_decode(file_get_contents($metaFile), true)['code'];
        }

        return [[
            'begin' => Memory::PROGRAM_OFFSET,
            'end'=> Memory::PROGRAM_OFFSET + $size
        ]];
    }

    private function translateOpcode(int $programCounter): string
    {
        $lineNo = sprintf('%4d ', $programCounter);

        try {
            $opcode = $this->memory->fetchOpcode($programCounter);
            $worker = $this->dispatcher->match($opcode);
            return $lineNo . $worker->getPseudocode($opcode);
        } catch (UnknownOpcode $exception) {
            return $lineNo . sprintf('[%s]', $exception->getOpcode());
        }
    }
}
