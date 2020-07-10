<?php

namespace Jaunas\Chip8\DataType;

class Registers extends GenericMemory
{
    const SIZE = 16;

    const CARRY = 0xF;

    public function __construct()
    {
        parent::__construct(self::SIZE);
    }

}
