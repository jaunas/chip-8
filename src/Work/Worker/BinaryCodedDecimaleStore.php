<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode FX33
 * Stores the binary-coded decimal representation of VX, with the most significant of three digits at the address in I,
 * the middle digit at I plus 1, and the least significant digit at I plus 2. (In other words, take the decimal
 * representation of VX, place the hundreds digit in memory at location in I, the tens digit at location I+1, and the
 * ones digit at location I+2.)
 */
class BinaryCodedDecimaleStore implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF033);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $number = $engine->registers[$opcode->getX()];

        $index = $engine->indexRegister;
        $engine->memory[$index] = (int) (($number % 1000) / 100);
        $engine->memory[$index + 1] = (int) (($number % 100) / 10);
        $engine->memory[$index + 2] = $number % 10;

        $engine->incrementProgramCounter();
    }
}
