<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

/**
 * Opcode BNNN
 * Jumps to the address NNN plus V0.
 */
class JumpToOffset implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0xB000);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $engine->programCounter = $engine->registers[0] + $opcode->getNNN();
    }
}
