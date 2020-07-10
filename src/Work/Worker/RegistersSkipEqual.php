<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode 5XY0
 * Skips the next instruction if VX equals VY. (Usually the next instruction is a jump to skip a code block)
 */
class RegistersSkipEqual implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x5000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        if ($engine->registers[$opcode->getX()] == $engine->registers[$opcode->getY()]) {
            $engine->incrementProgramCounter();
        }

        $engine->incrementProgramCounter();
    }
}
