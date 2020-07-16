<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

abstract class AbstractWorker
{

    /** @var Engine */
    protected $engine;

    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }

    abstract public function match(Opcode $opcode): bool;

    abstract public function execute(Opcode $opcode);
}
