<?php

namespace Jaunas\Chip8\Work\Worker\Sprite;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\DataType\Registers;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

/**
 * Opcode FX29
 *
 * Sets I to the location of the sprite for the character in VX. Characters 0-F (in hexadecimal) are represented
 * by a 4x5 font.
 */
class GetAddress implements WorkerInterface
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF029);
    }

    public function execute(Opcode $opcode, Engine $engine)
    {
        $character = $engine->registers[$opcode->getX()];
        if ($character > 15) {
            $character = 0;
        }

        $engine->indexRegister = $character * 5;

        $engine->incrementProgramCounter();
    }
}
