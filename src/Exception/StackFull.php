<?php

namespace Jaunas\Chip8\Exception;

use Exception;

class StackFull extends Exception
{
    public function __construct()
    {
        parent::__construct('Stack is full.');
    }
}
