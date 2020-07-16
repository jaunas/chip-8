<?php

namespace Jaunas\Chip8\Tests\Unit\Work\Worker\Register;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\DataType\Registers;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\Register\Set;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{

    /**
     * @dataProvider matchFailProvider
     */
    public function testMatchFail(int $opcode)
    {
        /** @var Engine|MockObject $engine */
        $engine = $this
            ->getMockBuilder(Engine::class)
            ->disableOriginalConstructor()
            ->getMock();

        $worker = new Set($engine);
        $opcode = new Opcode($opcode);

        $this->assertFalse($worker->match($opcode));
    }

    public function matchFailProvider(): array
    {
        return [[0x5000], [0x779C]];
    }

    /**
     * @dataProvider matchPassProvider
     */
    public function testExecute(int $opcode, int $index, int $value)
    {
        $registers = new Registers();

        /** @var Engine|MockObject $engine */
        $engine = $this
            ->getMockBuilder(Engine::class)
            ->disableOriginalConstructor()
            ->getMock();

        $engine->registers = $registers;

        $worker = new Set($engine);
        $opcode = new Opcode($opcode);

        $this->assertTrue($worker->match($opcode));

        $expectedDump = array_fill(0, Registers::SIZE, 0);
        $this->assertEquals($expectedDump, $engine->registers->dump());
        $worker->execute($opcode);

        $expectedDump[$index] = $value;
        $this->assertEquals($expectedDump, $engine->registers->dump());
    }

    public function matchPassProvider(): array
    {
        return [
            [0x6000, 0, 0],
            [0x679C, 7, 0x9C],
        ];
    }
}
