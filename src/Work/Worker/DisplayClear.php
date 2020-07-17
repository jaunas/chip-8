<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;

/**
 * Opcode 00E0
 * Clears the screen.
 */
final class DisplayClear extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xFFFF, 0x00E0);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->screen->format();

        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return 'disp_clear();';
    }
}
