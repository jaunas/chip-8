<?php

namespace Jaunas\Chip8\DataType;

class Opcode
{

    /** @var int */
    private $opcode;

    public function __construct(int $raw)
    {
        $this->opcode = $raw;
    }

    public function match(int $mask, int $result): bool
    {
        return $result === ($this->opcode & $mask);
    }

    public function getRaw(): int
    {
        return $this->opcode;
    }

    public function getX(): int
    {
        return $this->opcode & 0x0F00 >> 8;
    }

    public function getY(): int
    {
        return $this->opcode & 0x00F0 >> 4;
    }

    public function getN(): int
    {
        return $this->opcode % 0x10;
    }

    public function getNN(): int
    {
        return $this->opcode % 0x100;
    }

    public function getNNN(): int
    {
        return $this->opcode % 0x1000;
    }

    public function __toString()
    {
        return sprintf("%04X", $this->opcode);
    }
}
