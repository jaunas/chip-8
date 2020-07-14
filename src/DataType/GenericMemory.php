<?php

namespace Jaunas\Chip8\DataType;

use ArrayAccess;
use Jaunas\Chip8\Exception\MemoryOutOfBounds;

class GenericMemory implements ArrayAccess
{

    /** @var string */
    protected $memory;

    /** @var int */
    private $size;

    public function __construct(int $size)
    {
        $this->size = $size;
        $this->format();
    }

    public function offsetExists($offset): bool
    {
        return $offset < $this->size;
    }

    public function offsetGet($offset): int
    {
        if ($offset >= $this->size) {
            throw new MemoryOutOfBounds();
        }

        return ord($this->memory[$offset]);
    }

    public function offsetSet($offset, $value): void
    {
        if ($offset >= $this->size) {
            throw new MemoryOutOfBounds();
        }

        if (!is_int($value)) {
            throw new \Exception('Value has to be an integer.');
        }

        $this->memory[$offset] = chr($value % 0x100);
    }

    public function offsetUnset($offset): void
    {
        if ($offset >= $this->size) {
            throw new MemoryOutOfBounds();
        }

        $this->memory[$offset] = 0;
    }

    public function insertBlock(GenericMemory $block, int $offset)
    {
        if ($offset + $block->size > $this->size) {
            throw new MemoryOutOfBounds();
        }

        $this->memory = substr_replace($this->memory, $block->memory, $offset, $block->size);
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public static function fromString(string $string): GenericMemory
    {
        $memory = new GenericMemory(strlen($string));
        foreach (str_split($string) as $index => $byte) {
            $memory[$index] = ord($byte);
        }

        return $memory;
    }

    public function getBlock(int $offset, int $size): GenericMemory
    {
        return GenericMemory::fromString(substr($this->memory, $offset, $size));
    }

    public function format()
    {
        $this->memory = str_pad("", $this->size, "\0");
    }
}
