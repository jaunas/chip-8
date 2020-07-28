<?php

namespace Jaunas\Chip8\Tests\Unit\DataType;

use Jaunas\Chip8\DataType\Stack;
use Jaunas\Chip8\Exception\StackEmpty;
use Jaunas\Chip8\Exception\StackFull;
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{

    public function testPopFromEmptyStack()
    {
        $stack = new Stack();

        $this->expectException(StackEmpty::class);
        $stack->pop();
    }

    public function testPushToFullStack()
    {
        $stack = new Stack();

        for ($i=0; $i<Stack::SIZE; $i++) {
            $stack->push($i);
        }

        $this->expectException(StackFull::class);
        $stack->push(100);
    }

    /**
     * @dataProvider pushAndPopProvider
     */
    public function testPushAndPop(array $sequence)
    {
        $stack = new Stack();

        foreach ($sequence as $call) {
            if ($call[0] == 'push') {
                $stack->push($call[1]);
            } elseif ($call[0] == 'pop') {
                $this->assertEquals($call[1], $stack->pop());
            }
        }
    }

    public function pushAndPopProvider(): array
    {
        return [
            [[
                ['push', 75],
                ['push', 80],
                ['pop', 80],
                ['push', 85],
                ['push', 90],
                ['push', 95],
                ['pop', 95],
                ['pop', 90],
                ['pop', 85],
                ['pop', 75],
            ]],
            [[
                ['push', 700],
                ['pop', 700]
            ]]
        ];
    }
}
