<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode 8XY0
 * Sets VX to the value of VY.
 */
class RegistersAssign implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x8000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->registers[$opcode->getX()] = $engine->registers[$opcode->getY()];
        $engine->incrementProgramCounter();
    }
}
