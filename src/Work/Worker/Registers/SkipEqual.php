<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 5XY0
 * Skips the next instruction if VX equals VY. (Usually the next instruction is a jump to skip a code block)
 */
final class SkipEqual extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x5000);
    }

    public function execute(Opcode $opcode)
    {
        if ($this->engine->registers[$opcode->getX()] == $this->engine->registers[$opcode->getY()]) {
            $this->engine->incrementProgramCounter();
        }

        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('if (V%s == V%s) skip;', $opcode->getX(), $opcode->getY());
    }
}
