<?php

namespace Jaunas\Chip8\DataType;

use Jaunas\Chip8\Exception\StackEmpty;
use Jaunas\Chip8\Exception\StackFull;

class Stack extends GenericMemory
{
    const SIZE = 16;

    /** @var int */
    private $pointer = 0;

    public function __construct()
    {
        parent::__construct(self::SIZE);
    }

    public function push(int $address)
    {
        if ($this->pointer >= self::SIZE) {
            throw new StackFull();
        }

        $this[$this->pointer] = $address;
        $this->pointer++;
    }

    public function pop(): int
    {
        if (0 == $this->pointer) {
            throw new StackEmpty();
        }

        return $this[--$this->pointer];
    }
}
