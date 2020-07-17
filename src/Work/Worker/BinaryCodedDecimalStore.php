<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;

/**
 * Opcode FX33
 * Stores the binary-coded decimal representation of VX, with the most significant of three digits at the address in I,
 * the middle digit at I plus 1, and the least significant digit at I plus 2. (In other words, take the decimal
 * representation of VX, place the hundreds digit in memory at location in I, the tens digit at location I+1, and the
 * ones digit at location I+2.)
 */
final class BinaryCodedDecimalStore extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF033);
    }

    public function execute(Opcode $opcode)
    {
        $number = $this->engine->registers[$opcode->getX()];

        $index = $this->engine->indexRegister;
        $this->engine->memory[$index] = (int) (($number % 1000) / 100);
        $this->engine->memory[$index + 1] = (int) (($number % 100) / 10);
        $this->engine->memory[$index + 2] = $number % 10;

        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('*(I+0..2) = BCD(V%s);', $opcode->getX());
    }
}
