<?php

namespace Jaunas\Chip8\Work\Worker\Registers;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode FX55
 * Stores V0 to VX (including VX) in memory starting at address I. The offset from I is increased by 1 for each value
 * written, but I itself is left unmodified.
 */
final class Dump extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF055);
    }

    public function execute(Opcode $opcode)
    {
        for ($i=0; $i<$opcode->getX(); $i++) {
            $this->engine->memory[$this->engine->indexRegister + $i] = $this->engine->registers[$i];
        }

        $this->engine->incrementProgramCounter();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('&I = V0..V%s;', $opcode->getX());
    }
}
