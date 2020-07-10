<?php

namespace Jaunas\Chip8\Tests\Unit\DataType;

use Jaunas\Chip8\DataType\GenericMemory;
use Jaunas\Chip8\DataType\Memory;
use PHPUnit\Framework\TestCase;

class GenericMemoryTest extends TestCase
{

    /**
     * @dataProvider memorySizeProvider
     */
    public function testMemoryIsEmpty(int $size)
    {
        $memory = new GenericMemory($size);

        $memoryDump = [];
        for ($i=0; $i < $size; $i++) {
            $memoryDump[] = $memory[$i];
        }

        $this->assertEquals(array_fill(0, $size, 0), $memoryDump);
    }

    /**
     * @dataProvider memorySizeProvider
     */
    public function testMemoryFill(int $size)
    {
        $memory = new GenericMemory($size);

        $expectedDump = [];

        srand(time());
        for ($i = 0; $i < $size; $i++) {
            $rand = rand() % 256;
            $memory[$i] = $rand;
            $expectedDump[] = $rand;
        }

        $memoryDump = [];
        for ($i = 0; $i < $size; $i++) {
            $memoryDump[] = $memory[$i];
        }

        $this->assertEquals($expectedDump, $memoryDump);
    }

    public function memorySizeProvider(): array
    {
        return [
            [4096],
            [16]
        ];
    }

    /**
     * @dataProvider insertMemoryBlockProvider
     */
    public function testInsertMemoryBlock(string $memory, string $block, int $offset, string $expectedMemory)
    {
        $memory = GenericMemory::fromString($memory);
        $block = GenericMemory::fromString($block);

        $memory->insertBlock($block, $offset);

        $memoryDump = [];
        for ($i = 0; $i < $memory->getSize(); $i++) {
            $memoryDump[] = chr($memory[$i]);
        }

        $this->assertEquals(str_split($expectedMemory), $memoryDump);
    }

    public function insertMemoryBlockProvider()
    {
        return [
            [
                "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                "123",
                0,
                "123DEFGHIJKLMNOPQRSTUVWXYZ"
            ],
            [
                "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                "123",
                20,
                "ABCDEFGHIJKLMNOPQRST123XYZ"
            ],
            [
                "ABCDEFGHIJKLMNOPQRSTUVWXYZ",
                "123",
                23,
                "ABCDEFGHIJKLMNOPQRSTUVW123"
            ]
        ];
    }
}
