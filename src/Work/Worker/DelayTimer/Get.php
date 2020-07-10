<?php

namespace Jaunas\Chip8\Work\Worker\DelayTimer;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode FX07
 * Sets VX to the value of the delay timer.
 */
class Get implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF007);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->registers[$opcode->getX()] = $engine->delayTimer;

        $engine->incrementProgramCounter();
    }
}
