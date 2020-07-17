<?php

namespace Jaunas\Chip8\Work\Worker\Register;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\DataType\Registers;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 8XY6
 * Stores the least significant bit of VX in VF and then shifts VX to the right by 1.
 */
final class ShiftRight extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x8006);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->registers[Registers::CARRY] = $this->engine->registers[$opcode->getX()] & 0x1;
        $this->engine->registers[$opcode->getX()] >>= 1;

        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('V%s >>= 1', $opcode->getX());
    }
}
