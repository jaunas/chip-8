<?php

namespace Jaunas\Chip8\Tests\Unit\DataType;

use Jaunas\Chip8\DataType\Opcode;
use PHPUnit\Framework\TestCase;

class OpcodeTest extends TestCase
{

    public function testMatch()
    {
        $opcode = new Opcode(0x679C);
        $this->assertTrue($opcode->match(0x0F00, 0x0700));
    }

    public function test__toString()
    {
        $opcode = new Opcode(0x679C);

        $this->assertEquals('679C', (string) $opcode);
    }

    public function test__construct()
    {
        $raw = 0x679C;
        $opcode = new Opcode($raw);

        $this->assertEquals($raw, $opcode->getRaw());
    }

    public function testGetN()
    {
        $opcode = new Opcode(0x679C);

        $this->assertEquals(0xC, $opcode->getN());
    }

    public function testGetNNN()
    {
        $opcode = new Opcode(0x679C);

        $this->assertEquals(0x79C, $opcode->getNNN());
    }

    public function testGetNN()
    {
        $opcode = new Opcode(0x679C);

        $this->assertEquals(0x9C, $opcode->getNN());
    }

    public function testGetX()
    {
        $opcode = new Opcode(0x679C);

        $this->assertEquals(0x7, $opcode->getX());
    }

    public function testGetY()
    {
        $opcode = new Opcode(0x679C);

        $this->assertEquals(0x9, $opcode->getY());
    }
}
