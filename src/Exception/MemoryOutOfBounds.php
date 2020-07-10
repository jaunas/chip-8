<?php

namespace Jaunas\Chip8\Exception;

use Exception;

class MemoryOutOfBounds extends Exception
{
    public function __construct()
    {
        parent::__construct('Access to memory out of bounds.');
    }
}
