<?php

namespace Jaunas\Chip8\Work\Worker\Sprite;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\DataType\Registers;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode DXYN
 *
 * Draws a sprite at coordinate (VX, VY) that has a width of 8 pixels and a height of N pixels. Each row of 8 pixels is
 * read as bit-coded starting from memory location I; I value doesn’t change after the execution of this instruction.
 * As described above, VF is set to 1 if any screen pixels are flipped from set to unset when the sprite is drawn, and
 * to 0 if that doesn’t happen
 */
final class Draw extends AbstractWorker
{

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF000, 0xD000);
    }

    public function execute(Opcode $opcode)
    {
        $height = $opcode->getN();
        $x = $this->engine->registers[$opcode->getX()];
        $y = $this->engine->registers[$opcode->getY()];

        $spriteData = $this->engine->memory->getBlock($this->engine->indexRegister, $height);
        $flipped = $this->engine->screen->drawSprite($spriteData, $x, $y);
        $this->engine->registers[Registers::CARRY] = $flipped ? 1 : 0;

        $this->engine->incrementProgramCounter();
    }
}
