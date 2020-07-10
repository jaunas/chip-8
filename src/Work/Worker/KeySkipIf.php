<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode EX9E
 * Skips the next instruction if the key stored in VX is pressed. (Usually the next instruction is a jump to skip a code
 * block)
 */
class KeySkipIf implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xE09E);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        if ($engine->keypad[$opcode->getX()] == 1) {
            $engine->incrementProgramCounter();
        }

        $engine->incrementProgramCounter();
    }
}
