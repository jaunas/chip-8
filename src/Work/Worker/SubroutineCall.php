<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode 2NNN
 * Calls subroutine at NNN.
 */
class SubroutineCall implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0x2000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->stack->push($engine->programCounter);
        $engine->programCounter = $opcode->getNNN();
    }
}
