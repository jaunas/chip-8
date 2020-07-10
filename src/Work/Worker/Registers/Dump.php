<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode FX55
 * Stores V0 to VX (including VX) in memory starting at address I. The offset from I is increased by 1 for each value
 * written, but I itself is left unmodified.
 */
class Dump implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF055);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        for ($i=0; $i<$opcode->getX(); $i++) {
            $engine->memory[$engine->indexRegister + $i] = $engine->registers[$i];
        }

        $engine->incrementProgramCounter();
    }
}
