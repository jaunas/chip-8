<?php

namespace Jaunas\Chip8\DataType;

use Jaunas\Chip8\Exception\StackEmpty;
use Jaunas\Chip8\Exception\StackFull;

class Stack
{
    const SIZE = 16;

    /** @var array */
    private $stack = [];

    public function push(int $address)
    {
        if (sizeof($this->stack) >= self::SIZE) {
            throw new StackFull();
        }

        array_push($this->stack, $address);
    }

    public function pop(): int
    {
        if (empty($this->stack)) {
            throw new StackEmpty();
        }

        return array_pop($this->stack);
    }
}
