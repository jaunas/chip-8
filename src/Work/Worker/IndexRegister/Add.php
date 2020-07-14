<?php

namespace Jaunas\Chip8\Work\Worker\IndexRegister;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode FX1E
 * Adds VX to I. VF is not affected.
 */
class Add implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF01E);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->indexRegister = ($engine->indexRegister + $engine->registers[$opcode->getX()]) % (1 << 16);

        $engine->incrementProgramCounter();
    }
}
