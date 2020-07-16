<?php

namespace Jaunas\Chip8\Work\Worker\IndexRegister;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode FX1E
 * Adds VX to I. VF is not affected.
 */
final class Add extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF01E);
    }

    public function execute(Opcode $opcode)
    {
        $x = $this->engine->registers[$opcode->getX()];
        $this->engine->indexRegister = ($this->engine->indexRegister + $x) % (1 << 16);

        $this->engine->incrementProgramCounter();
    }
}
