<?php

namespace Jaunas\Chip8\Work\Worker\DelayTimer;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode FX15
 * Sets the delay timer to VX.
 */
final class Set extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF015);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->delayTimer = $this->engine->registers[$opcode->getX()];

        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('delay_timer = V%s;', $opcode->getX());
    }
}
