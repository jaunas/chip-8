<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode ANNN
 * Sets index register to the address NNN.
 */
class IndexRegisterSet implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0xA000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->indexRegister = $opcode->getNNN();
        $engine->incrementProgramCounter();
    }
}
