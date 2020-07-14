<?php

namespace Jaunas\Chip8\Tests\Unit;

use Jaunas\Chip8\DataType\Memory;
use Jaunas\Chip8\Emulator;
use PHPUnit\Framework\TestCase;

class EmulatorTest extends TestCase
{

    public function testLoadProgramFromFile()
    {
        $programPath = __DIR__ . '/../../examples/Zero Demo.ch8';

        $emulator = new Emulator();
        $emulator->loadProgramFromFile(__DIR__ . '/../../examples/Zero Demo.ch8');

        $programString = file_get_contents($programPath);

        $expectedOpcodes = [];
        $opcodes = [];
        for ($i=0; $i < strlen($programString) / 2; $i++) {
            $expectedOpcodes[] = $this->opcodeFromString($programString, $i*2);
            $opcodes[] = $emulator->engine->memory->fetchOpcode(Memory::PROGRAM_OFFSET + $i*2)->getRaw();
        }

        $this->assertEquals($expectedOpcodes, $opcodes);
    }

    private function opcodeFromString(string $string, int $offset)
    {
        $opcodeString = substr($string, $offset, 2);
        $bytes = str_split($opcodeString);

        return ord($bytes[0]) << 8 | ord($bytes[1]);
    }
}
