<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode FX1E
 * Adds VX to I. VF is not affected.
 */
class IndexRegisterAdd implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0xA000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->indexRegister = ($engine->indexRegister + $engine->registers[$opcode->getX()]) % (1 << 16);

        $engine->incrementProgramCounter();
    }
}
