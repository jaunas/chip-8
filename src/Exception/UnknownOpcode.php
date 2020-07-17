<?php


namespace Jaunas\Chip8\Exception;

use Exception;
use Jaunas\Chip8\DataType\Opcode;

class UnknownOpcode extends Exception
{

    /** @var Opcode */
    private $opcode;

    public function __construct(Opcode $opcode)
    {
        $this->opcode = $opcode;

        parent::__construct('Unknown opcode ' . $this->opcode);
    }

    public static function byOpcode(Opcode $opcode)
    {
        return new self($opcode);
    }

    public function getOpcode(): Opcode
    {
        return $this->opcode;
    }
}
