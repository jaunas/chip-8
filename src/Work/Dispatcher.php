<?php

namespace Jaunas\Chip8\Work;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Exception\UnknownOpcode;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

class Dispatcher
{

    /** @var WorkerInterface[] */
    private $workers = [];

    public function addWorker(WorkerInterface $worker)
    {
        $this->workers[] = $worker;
    }

    public function dispatch(Opcode $opcode, Engine $engine)
    {
        foreach ($this->workers as $worker) {
            if ($worker->match($opcode)) {
                $worker->execute($opcode, $engine);

                return;
            }
        }

        throw UnknownOpcode::byOpcode($opcode);
    }
}
