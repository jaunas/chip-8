<?php

namespace Jaunas\Chip8\Work\Worker\Jump;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode 1NNN
 * Jumps to address NNN.
 */
class To implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0x1000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->programCounter = $opcode->getNNN();
    }
}
