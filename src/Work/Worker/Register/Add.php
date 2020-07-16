<?php

namespace Jaunas\Chip8\Work\Worker\Register;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 7XNN
 * Adds NN to VX. (Carry flag is not changed)
 */
final class Add extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0x7000);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->registers[$opcode->getX()] += $opcode->getNN();
        $this->engine->incrementProgramCounter();
    }
}
