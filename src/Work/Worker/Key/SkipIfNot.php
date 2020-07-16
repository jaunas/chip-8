<?php

namespace Jaunas\Chip8\Work\Worker\Key;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode EXA1
 * Skips the next instruction if the key stored in VX isn't pressed. (Usually the next instruction is a jump to skip a
 * code block)
 */
final class SkipIfNot extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xE0A1);
    }

    public function execute(Opcode $opcode)
    {
        if ($this->engine->keypad[$opcode->getX()] != 1) {
            $this->engine->incrementProgramCounter();
        }

        $this->engine->incrementProgramCounter();
    }
}
