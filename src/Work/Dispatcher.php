<?php

namespace Jaunas\Chip8\Work;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Exception\UnknownOpcode;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

class Dispatcher
{

    /** @var WorkerInterface[] */
    private $workers = [];

    public function __construct()
    {
        foreach ($this->getWorkers() as $worker) {
            $this->addWorker(new $worker);
        }
    }

    public function addWorker(WorkerInterface $worker)
    {
        $this->workers[] = $worker;
    }

    public function dispatch(Opcode $opcode, Engine $engine)
    {
        foreach ($this->workers as $worker) {
            if ($worker->match($opcode)) {
                $worker->execute($opcode, $engine);

                return;
            }
        }

        throw UnknownOpcode::byOpcode($opcode);
    }

    private function getWorkers(): array
    {
        return [
            \Jaunas\Chip8\Work\Worker\BinaryCodedDecimalStore::class,
            \Jaunas\Chip8\Work\Worker\DelayTimer\Get::class,
            \Jaunas\Chip8\Work\Worker\DelayTimer\Set::class,
            \Jaunas\Chip8\Work\Worker\DisplayClear::class,
            \Jaunas\Chip8\Work\Worker\GenerateRandomNumber::class,
            \Jaunas\Chip8\Work\Worker\IndexRegister\Add::class,
            \Jaunas\Chip8\Work\Worker\IndexRegister\Set::class,
            \Jaunas\Chip8\Work\Worker\Jump\To::class,
            \Jaunas\Chip8\Work\Worker\Jump\ToOffset::class,
            \Jaunas\Chip8\Work\Worker\Key\Get::class,
            \Jaunas\Chip8\Work\Worker\Key\SkipIf::class,
            \Jaunas\Chip8\Work\Worker\Key\SkipIfNot::class,
            \Jaunas\Chip8\Work\Worker\Register\Add::class,
            \Jaunas\Chip8\Work\Worker\Register\Set::class,
            \Jaunas\Chip8\Work\Worker\Register\ShiftLeft::class,
            \Jaunas\Chip8\Work\Worker\Register\ShiftRight::class,
            \Jaunas\Chip8\Work\Worker\Register\SkipEqual::class,
            \Jaunas\Chip8\Work\Worker\Register\SkipNotEqual::class,
            \Jaunas\Chip8\Work\Worker\Registers\Add::class,
            \Jaunas\Chip8\Work\Worker\Registers\Assign::class,
            \Jaunas\Chip8\Work\Worker\Registers\Dump::class,
            \Jaunas\Chip8\Work\Worker\Registers\Load::class,
            \Jaunas\Chip8\Work\Worker\Registers\LogicalAnd::class,
            \Jaunas\Chip8\Work\Worker\Registers\LogicalOr::class,
            \Jaunas\Chip8\Work\Worker\Registers\LogicalXor::class,
            \Jaunas\Chip8\Work\Worker\Registers\SkipEqual::class,
            \Jaunas\Chip8\Work\Worker\Registers\Subtract::class,
            \Jaunas\Chip8\Work\Worker\Registers\SubtractReverse::class,
            \Jaunas\Chip8\Work\Worker\SoundTimerSet::class,
            \Jaunas\Chip8\Work\Worker\Sprite\Draw::class,
            \Jaunas\Chip8\Work\Worker\Sprite\GetAddress::class,
            \Jaunas\Chip8\Work\Worker\Subroutine\Call::class,
            \Jaunas\Chip8\Work\Worker\Subroutine\ReturnFrom::class,
        ];
    }
}
