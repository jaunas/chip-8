<?php

namespace Jaunas\Chip8\Work\Worker\Key;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode EX9E
 * Skips the next instruction if the key stored in VX is pressed. (Usually the next instruction is a jump to skip a code
 * block)
 */
final class SkipIf extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xE09E);
    }

    public function execute(Opcode $opcode)
    {
        if ($this->engine->keypad[$opcode->getX()] == 1) {
            $this->engine->incrementProgramCounter();
        }

        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('if (V%s == key()) skip;', $opcode->getX());
    }
}
