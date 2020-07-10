<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode 4XNN
 * Skips the next instruction if VX doesn't equal NN. (Usually the next instruction is a jump to skip a code block)
 */
class SkipNotEqual implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0x4000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        if ($engine->registers[$opcode->getX()] != $opcode->getNN()) {
            $engine->incrementProgramCounter();
        }

        $engine->incrementProgramCounter();
    }
}
