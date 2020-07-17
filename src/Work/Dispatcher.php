<?php

namespace Jaunas\Chip8\Work;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Exception\UnknownOpcode;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

final class Dispatcher
{

    /** @var AbstractWorker[] */
    private $workers = [];

    public function addWorker(AbstractWorker $worker)
    {
        $this->workers[] = $worker;
    }

    public function dispatch(Opcode $opcode)
    {
        $worker = $this->match($opcode);
        $worker->execute($opcode);
    }

    public function match(Opcode $opcode): AbstractWorker
    {
        foreach ($this->workers as $worker) {
            if ($worker->match($opcode)) {
                return $worker;
            }
        }

        throw UnknownOpcode::byOpcode($opcode);
    }
}
