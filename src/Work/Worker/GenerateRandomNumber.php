<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;

/**
 * Opcode CXNN
 * Sets VX to the result of a bitwise and operation on a random number (Typically: 0 to 255) and NN.
 */
final class GenerateRandomNumber extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0xC000);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->registers[$opcode->getX()] = rand(0x00, 0xFF) & $opcode->getNN();
        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('V%s = rand() & %s;', $opcode->getX(), $opcode->getNN());
    }
}
