<?php

namespace Jaunas\Chip8\Work\Worker\Subroutine;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode 00EE
 * Returns from a subroutine.
 */
class ReturnFrom implements WorkerInterface
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
