<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 9XY0
 * Skips the next instruction if VX doesn't equal VY. (Usually the next instruction is a jump to skip a code block)
 */
final class SkipNotEqual extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF00F, 0x9000);
    }

    public function execute(Opcode $opcode)
    {
        if ($this->engine->registers[$opcode->getX()] != $this->engine->registers[$opcode->getY()]) {
            $this->engine->incrementProgramCounter();
        }

        $this->engine->incrementProgramCounter();
    }
}
