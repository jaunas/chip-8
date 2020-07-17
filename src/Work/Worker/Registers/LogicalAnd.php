<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 8XY2
 * Sets VX to VX or VY. (Bitwise AND operation)
 */
final class LogicalAnd extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x8002);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->registers[$opcode->getX()] &= $this->engine->registers[$opcode->getY()];
        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('V%s &= V%s;', $opcode->getX(), $opcode->getY());
    }
}
