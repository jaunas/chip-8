<?php

namespace Jaunas\Chip8;

use Jaunas\Chip8\DataType\GenericMemory;
use Jaunas\Chip8\DataType\Memory;
use Jaunas\Chip8\DataType\Screen;
use Jaunas\Chip8\Work\Dispatcher;

final class Emulator
{

    /** @var Screen */
    private $screen;


    /** @var int */
    private $soundTimer;

    /** @var Engine */
    private $engine;

    /** @var Dispatcher */
    private $dispatcher;

    public function __construct()
    {
        $this->engine = new Engine();
        $this->screen = new Screen();
        $this->dispatcher = new Dispatcher();
    }

    public function loadProgramFromFile(string $filepath)
    {
        $program = GenericMemory::fromString(file_get_contents($filepath));
        $this->engine->loadProgramToMemory($program);
    }

    public function run()
    {
        $this->cycle();
    }

    private function cycle()
    {
        $this->dispatcher->dispatch($this->engine->fetchOpcode(), $this->engine);
        $this->updateTimers();
    }

    private function updateTimers()
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
