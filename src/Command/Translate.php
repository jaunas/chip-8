<?php

namespace Jaunas\Chip8\Command;

use Jaunas\Chip8\DataType\GenericMemory;
use Jaunas\Chip8\DataType\Memory;
use Jaunas\Chip8\Exception\UnknownOpcode;
use Jaunas\Chip8\Work\Dispatcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
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
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $program = GenericMemory::fromString(file_get_contents($input->getArgument('file')));
        $this->memory->loadProgram($program);

        $size = $program->getSize();

        for ($i=0; $i<$size; $i+=2) {
            $programCounter = Memory::PROGRAM_OFFSET + $i;
            $output->write(sprintf('%4d ', $programCounter));
            try {
                $opcode = $this->memory->fetchOpcode($programCounter);
                $worker = $this->dispatcher->match($opcode);
                $output->writeln($worker->getPseudocode($opcode));
            } catch (UnknownOpcode $exception) {
                $output->writeln(sprintf('[%s]', $exception->getOpcode()));
            }
        }

        return 0;
    }
}
