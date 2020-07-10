<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode 8XY2
 * Sets VX to VX or VY. (Bitwise AND operation)
 */
class RegistersAnd implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x8002);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->registers[$opcode->getX()] &= $engine->registers[$opcode->getY()];
        $engine->incrementProgramCounter();
    }
}
