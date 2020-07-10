<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode FX18
 * Sets the sound timer to VX.
 */
class SoundTimerSet implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF018);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->delayTimer = $engine->registers[$opcode->getX()];

        $engine->incrementProgramCounter();
    }
}
