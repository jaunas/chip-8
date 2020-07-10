<?php

namespace Jaunas\Chip8\Work\Worker;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;

interface WorkerInterface
{

    public function match(Opcode $opcode): bool;

    public function execute(Opcode $opcode, Engine $engine);
}
