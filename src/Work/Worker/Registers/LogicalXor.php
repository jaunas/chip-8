<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 8XY3
 * Sets VX to VX xor VY.
 */
final class LogicalXor extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x8003);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->registers[$opcode->getX()] ^= $this->engine->registers[$opcode->getY()];
        $this->engine->incrementProgramCounter();
    }
}
