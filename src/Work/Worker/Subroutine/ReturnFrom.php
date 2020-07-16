<?php

namespace Jaunas\Chip8\Work\Worker\Subroutine;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 00EE
 * Returns from a subroutine.
 */
final class ReturnFrom extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xFFFF, 0x00EE);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->programCounter = $this->engine->stack->pop();
        $this->engine->incrementProgramCounter();
    }
}
