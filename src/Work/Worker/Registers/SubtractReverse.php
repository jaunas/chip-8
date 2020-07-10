<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\DataType\Registers;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode 8XY7
 * Sets VX to VY minus VX. VF is set to 0 when there's a borrow, and 1 when there isn't.
 */
class SubtractReverse implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x8005);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        if (($engine->registers[$opcode->getY()] - $engine->registers[$opcode->getX()] < 0)) {
            $engine->registers[Registers::CARRY] = 1;
        } else {
            $engine->registers[Registers::CARRY] = 0;
        }

        $engine->registers[$opcode->getX()] = $engine->registers[$opcode->getY()] - $engine->registers[$opcode->getX()];
        $engine->incrementProgramCounter();
    }
}
