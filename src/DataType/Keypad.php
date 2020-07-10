<?php

namespace Jaunas\Chip8\DataType;

class Keypad extends GenericMemory
{
    const SIZE = 16;

    public function __construct()
    {
        parent::__construct(self::SIZE);
    }

}
