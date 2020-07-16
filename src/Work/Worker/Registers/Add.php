<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\DataType\Registers;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 8XY4
 * Adds VY to VX. VF is set to 1 when there's a carry, and to 0 when there isn't.
 */
final class Add extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x8004);
    }

    public function execute(Opcode $opcode)
    {
        if (($this->engine->registers[$opcode->getX()] + $this->engine->registers[$opcode->getY()] > 0xFF)) {
            $this->engine->registers[Registers::CARRY] = 1;
        } else {
            $this->engine->registers[Registers::CARRY] = 0;
        }

        $this->engine->registers[$opcode->getX()] += $this->engine->registers[$opcode->getY()];
        $this->engine->incrementProgramCounter();
    }
}
