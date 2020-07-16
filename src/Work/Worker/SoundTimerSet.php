<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;

/**
 * Opcode FX18
 * Sets the sound timer to VX.
 */
final class SoundTimerSet extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF018);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->delayTimer = $this->engine->registers[$opcode->getX()];

        $this->engine->incrementProgramCounter();
    }
}
