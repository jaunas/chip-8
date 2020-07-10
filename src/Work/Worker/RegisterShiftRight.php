<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\DataType\Registers;
use Jaunas\Chip8\Engine;

/**
 * Opcode 8XY6
 * Stores the least significant bit of VX in VF and then shifts VX to the right by 1.
 */
class RegisterShiftRight implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x8006);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->registers[Registers::CARRY] = $engine->registers[$opcode->getX()] & 0x1;
        $engine->registers[$opcode->getX()] >>= 1;

        $engine->incrementProgramCounter();
    }
}
