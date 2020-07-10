<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode 7XNN
 * Adds NN to VX. (Carry flag is not changed)
 */
class RegisterAdd implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0x7000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->registers[$opcode->getX()] += $opcode->getNN();
        $engine->incrementProgramCounter();
    }
}
