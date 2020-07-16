<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode 9XY0
 * Skips the next instruction if VX doesn't equal VY. (Usually the next instruction is a jump to skip a code block)
 */
class SkipNotEqual implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x9000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        if ($engine->registers[$opcode->getX()] != $engine->registers[$opcode->getY()]) {
            $engine->incrementProgramCounter();
        }

        $engine->incrementProgramCounter();
    }
}
