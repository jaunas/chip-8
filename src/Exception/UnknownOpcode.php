<?php


namespace Jaunas\Chip8\Exception;

use Exception;
use Jaunas\Chip8\DataType\Opcode;

class UnknownOpcode extends Exception
{
    public static function byOpcode(Opcode $opcode)
    {
        return new self('Unknown opcode ' . $opcode);
    }
}