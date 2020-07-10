<?php

namespace Jaunas\Chip8\Work\Worker\Register;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode 3XNN
 * Skips the next instruction if VX equals NN. (Usually the next instruction is a jump to skip a code block)
 */
class SkipEqual implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0x3000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        if ($engine->registers[$opcode->getX()] == $opcode->getNN()) {
            $engine->incrementProgramCounter();
        }

        $engine->incrementProgramCounter();
    }
}
