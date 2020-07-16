<?php

namespace Jaunas\Chip8\Work\Worker\Subroutine;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 2NNN
 * Calls subroutine at NNN.
 */
final class Call extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0x2000);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->stack->push($this->engine->programCounter);
        $this->engine->programCounter = $opcode->getNNN();
    }
}
