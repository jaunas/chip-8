<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode 00E0
 * Clears the screen.
 */
class DisplayClear implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xFFFF, 0x00E0);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->screen->format();

        $engine->incrementProgramCounter();
    }
}
