<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode CXNN
 * Sets VX to the result of a bitwise and operation on a random number (Typically: 0 to 255) and NN.
 */
class GenerateRandomNumber implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0xC000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->registers[$opcode->getX()] = rand(0x00, 0xFF) & $opcode->getNN();
        $engine->incrementProgramCounter();
    }
}
