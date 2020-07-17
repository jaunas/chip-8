<?php

namespace Jaunas\Chip8\Work\Worker\Register;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 6XNN
 * Sets VX to NN.
 */
final class Set extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0x6000);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->registers[$opcode->getX()] = $opcode->getNN();
        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('V%s = %s;', $opcode->getX(), $opcode->getNN());
    }
}
