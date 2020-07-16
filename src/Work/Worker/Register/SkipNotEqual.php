<?php

namespace Jaunas\Chip8\Work\Worker\Register;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 4XNN
 * Skips the next instruction if VX doesn't equal NN. (Usually the next instruction is a jump to skip a code block)
 */
final class SkipNotEqual extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0x4000);
    }

    public function execute(Opcode $opcode)
    {
        if ($this->engine->registers[$opcode->getX()] != $opcode->getNN()) {
            $this->engine->incrementProgramCounter();
        }

        $this->engine->incrementProgramCounter();
    }
}
