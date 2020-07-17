<?php

namespace Jaunas\Chip8\Work\Worker\Jump;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode BNNN
 * Jumps to the address NNN plus V0.
 */
final class ToOffset extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0xB000);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->programCounter = $this->engine->registers[0] + $opcode->getNNN();
    }

    public function getPseudocode(Opcode $opcode): string
    {
        return sprintf('goto V0 + %s;', $opcode->getNNN());
    }
}
