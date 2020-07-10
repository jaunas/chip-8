<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode 00EE
 * Returns from a subroutine.
 */
class SubroutineReturn implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xFFFF, 0x00EE);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->programCounter = $engine->stack->pop();
        $engine->incrementProgramCounter();
    }
}
