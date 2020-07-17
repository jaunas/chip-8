<?php

namespace Jaunas\Chip8\Work\Worker\DelayTimer;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode FX07
 * Sets VX to the value of the delay timer.
 */
final class Get extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF007);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->registers[$opcode->getX()] = $this->engine->delayTimer;

        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('V%s = delay_timer;', $opcode->getX());
    }
}
