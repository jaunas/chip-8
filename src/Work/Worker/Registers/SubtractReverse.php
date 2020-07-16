<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\DataType\Registers;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 8XY7
 * Sets VX to VY minus VX. VF is set to 0 when there's a borrow, and 1 when there isn't.
 */
final class SubtractReverse extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x8005);
    }

    public function execute(Opcode $opcode)
    {
        if (($this->engine->registers[$opcode->getY()] - $this->engine->registers[$opcode->getX()] < 0)) {
            $this->engine->registers[Registers::CARRY] = 1;
        } else {
            $this->engine->registers[Registers::CARRY] = 0;
        }

        $x = $this->engine->registers[$opcode->getX()];
        $y = $this->engine->registers[$opcode->getY()];
        $this->engine->registers[$opcode->getX()] = $y - $x;

        $this->engine->incrementProgramCounter();
    }
}
