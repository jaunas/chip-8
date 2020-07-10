<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode FX65
 * Fills V0 to VX (including VX) with values from memory starting at address I. The offset from I is increased by 1 for
 * each value written, but I itself is left unmodified.
 */
class Load implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF055);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        for ($i=0; $i<$opcode->getX(); $i++) {
            $engine->registers[$i] = $engine->memory[$engine->indexRegister + $i];
        }

        $engine->incrementProgramCounter();
    }
}
