<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\DataType\Registers;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode 8XY4
 * Adds VY to VX. VF is set to 1 when there's a carry, and to 0 when there isn't.
 */
class Add implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x8004);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        if (($engine->registers[$opcode->getX()] + $engine->registers[$opcode->getY()] > 0xFF)) {
            $engine->registers[Registers::CARRY] = 1;
        } else {
            $engine->registers[Registers::CARRY] = 0;
        }

        $engine->registers[$opcode->getX()] += $engine->registers[$opcode->getY()];
        $engine->incrementProgramCounter();
    }
}
