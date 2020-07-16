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

    /** @var Screen */
    public $screen;

    /** @var Keypad */
    public $keypad;

    /** @var int */
    public $delayTimer;

    /** @var int */
    private $soundTimer;

    public function __construct(
        Memory $memory,
        Stack $stack,
        Registers $registers,
        Screen $screen,
        Keypad $keypad
    ) {
        $this->memory = $memory;
        $this->stack = $stack;
        $this->registers = $registers;
        $this->screen = $screen;
        $this->keypad = $keypad;

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

    public function updateTimers()
    {
        if ($this->delayTimer > 0) {
            $this->delayTimer--;
        }

        if ($this->soundTimer > 0) {
            if ($this->soundTimer == 1) {
                echo 'BEEP';
            }

            $this->soundTimer--;
        }
    }
}
