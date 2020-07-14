<?php

namespace Jaunas\Chip8;

use Jaunas\Chip8\DataType\GenericMemory;
use Jaunas\Chip8\Work\Dispatcher;

final class Emulator
{

    /** @var Engine */
    private $engine;

    /** @var Dispatcher */
    private $dispatcher;

    public function __construct()
    {
        $this->engine = new Engine();
        $this->dispatcher = new Dispatcher();
    }

    public function loadProgramFromFile(string $filepath)
    {
        $program = GenericMemory::fromString(file_get_contents($filepath));
        $this->engine->loadProgramToMemory($program);
    }

    public function run()
    {
        while (true) {
            $this->cycle();
            usleep(100000);
        }
    }

    private function cycle()
    {
        $this->dispatcher->dispatch($this->engine->fetchOpcode(), $this->engine);
        $this->engine->updateTimers();
        $this->engine->terminal->refreshScreen($this->engine->screen);
    }
}
