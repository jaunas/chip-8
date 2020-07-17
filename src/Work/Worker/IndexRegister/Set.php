<?php

namespace Jaunas\Chip8\Work\Worker\IndexRegister;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode ANNN
 * Sets index register to the address NNN.
 */
final class Set extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0xA000);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->indexRegister = $opcode->getNNN();
        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('I = %s;', $opcode->getNNN());
    }
}
