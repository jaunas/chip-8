<?php

namespace Jaunas\Chip8;

use Jaunas\Chip8\DataType\GenericMemory;
use Jaunas\Chip8\Work\Dispatcher;

final class Emulator
{

    /** @var Engine */
    public $engine;

    /** @var Dispatcher */
    private $dispatcher;

    /** @var Terminal */
    public $terminal;

    public function __construct(Engine $engine, Dispatcher $dispatcher, Terminal $terminal)
    {
        $this->engine = $engine;
        $this->dispatcher = $dispatcher;
        $this->terminal = $terminal;
    }

    public function loadProgramFromFile(string $filepath)
    {
        $program = GenericMemory::fromString(file_get_contents($filepath));
        $this->engine->loadProgramToMemory($program);
    }

    public function run()
    {
        $this->terminal->open();

        while (true) {
            $this->cycle();
            usleep(1000);
        }
    }

    private function cycle()
    {
        $this->dispatcher->dispatch($this->engine->fetchOpcode());
        $this->engine->updateTimers();
        $this->terminal->refresh($this->engine);
    }
}
