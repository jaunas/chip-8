<?php

namespace Jaunas\Chip8\Tests\Unit\DataType;

use Jaunas\Chip8\DataType\GenericMemory;
use Jaunas\Chip8\DataType\Memory;
use PHPUnit\Framework\TestCase;

class MemoryTest extends TestCase
{

    public function testLoadProgram()
    {
        $programBytes = "\xBA\xDC\x0D\xEA\xDD\xC0\xFF\xEE";

        $memory = new Memory();
        $program = GenericMemory::fromString($programBytes);

        $memory->loadProgram($program);

        $memoryDump = [];

        for ($i = Memory::PROGRAM_OFFSET; $i < Memory::PROGRAM_OFFSET + strlen($programBytes); $i++) {
            $memoryDump[] = $memory[$i];
        }

        $this->assertEquals($this->stringToArrayOfOrd($programBytes), $memoryDump);
    }

    private function stringToArrayOfOrd(string $string)
    {
        return array_map(
            function (string $byte) {
                return ord($byte);
            },
            str_split($string)
        );
    }

    public function testFetchOpcode()
    {
        $programBytes = "\xBA\xDC\x0D\xEA\xDD\xC0\xFF\xEE";

        $memory = new Memory();
        $program = GenericMemory::fromString($programBytes);

        $memory->loadProgram($program);

        $opcode = $memory->fetchOpcode(Memory::PROGRAM_OFFSET);

        $this->assertEquals(0xBADC, $opcode->getRaw());
    }
}
