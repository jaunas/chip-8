<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode FX07
 * Sets VX to the value of the delay timer.
 */
class DelayTimerGet implements WorkerInterface
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
