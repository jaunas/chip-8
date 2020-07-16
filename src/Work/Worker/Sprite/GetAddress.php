<?php

namespace Jaunas\Chip8\Work\Worker\Sprite;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode FX29
 *
 * Sets I to the location of the sprite for the character in VX. Characters 0-F (in hexadecimal) are represented
 * by a 4x5 font.
 */
final class GetAddress extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF029);
    }

    public function execute(Opcode $opcode)
    {
        $character = $this->engine->registers[$opcode->getX()];
        if ($character > 15) {
            $character = 0;
        }

        $this->engine->indexRegister = $character * 5;

        $this->engine->incrementProgramCounter();
    }
}
