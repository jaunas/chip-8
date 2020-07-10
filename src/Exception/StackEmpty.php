<?php

namespace Jaunas\Chip8\Exception;

use Exception;

class StackEmpty extends Exception
{
    public function __construct()
    {
        parent::__construct('Stack is empty.');
    }
}
