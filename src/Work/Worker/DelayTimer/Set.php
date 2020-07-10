<?php

namespace Jaunas\Chip8\Work\Worker\DelayTimer;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode FX15
 * Sets the delay timer to VX.
 */
class Set implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF015);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->delayTimer = $engine->registers[$opcode->getX()];

        $engine->incrementProgramCounter();
    }
}
