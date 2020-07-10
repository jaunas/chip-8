<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode FX0A
 * A key press is awaited, and then stored in VX. (Blocking Operation. All instruction halted until next key event)
 */
class KeyGet implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF00A);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->registers[$opcode->getX()] = $engine->terminal->getPressedKey();

        $engine->incrementProgramCounter();
    }
}
