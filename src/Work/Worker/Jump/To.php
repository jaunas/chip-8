<?php

namespace Jaunas\Chip8\Work\Worker\Jump;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode 1NNN
 * Jumps to address NNN.
 */
final class To extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0x1000);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->programCounter = $opcode->getNNN();
    }
}
