<?php

namespace Jaunas\Chip8\Work;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Work\Worker\IndexRegisterSet;
use Jaunas\Chip8\Work\Worker\WorkerInterface;

class Dispatcher
{

    /** @var WorkerInterface[] */
    private $workers = [];

    public function __construct()
    {
        $this->addWorker(new IndexRegisterSet());
    }

    public function addWorker(WorkerInterface $worker)
    {
        $this->workers[] = $worker;
    }

    public function dispatch(Opcode $opcode, Engine $engine)
    {
        foreach ($this->workers as $worker) {
            if ($worker->match($opcode)) {
                $worker->execute($opcode, $engine);
            }

            return;
        }

        throw new \Exception(sprintf("No matching worker found for opcode 0x%X", $opcode));
    }
}
