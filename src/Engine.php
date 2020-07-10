<?php

namespace Jaunas\Chip8;

use Jaunas\Chip8\DataType\GenericMemory;
use Jaunas\Chip8\DataType\Keypad;
use Jaunas\Chip8\DataType\Memory;
use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\DataType\Registers;
use Jaunas\Chip8\DataType\Screen;
use Jaunas\Chip8\DataType\Stack;

class Engine
{
    /** @var int */
    public $indexRegister = 0;

    /** @var int */
    public $programCounter = Memory::PROGRAM_OFFSET;

    /** @var Memory */
    public $memory;

    /** @var Stack */
    public $stack;

    /** @var Registers */
    public $registers;

    const REGISTERS_SIZE = 16;

    /** @var Screen */
    public $screen;

    /** @var Terminal */
    public $terminal;

    /** @var Keypad */
    public $keypad;

    /** @var int */
    public $delayTimer;

    public function __construct()
    {
        $this->memory = new Memory();
        $this->stack = new Stack();
        $this->registers = new Registers();
        $this->screen = new Screen();
        $this->keypad = new Keypad();

        srand(time());
    }

    public function incrementProgramCounter(int $step = 2)
    {
        $this->programCounter = ($this->programCounter + $step) % (1 << 16);
    }

    public function fetchOpcode(): Opcode
    {
        return $this->memory->fetchOpcode($this->programCounter);
    }

    public function loadProgramToMemory(GenericMemory $program)
    {
        $this->memory->loadProgram($program);
    }
}
