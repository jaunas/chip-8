<?php

namespace Jaunas\Chip8\Work\Worker\Key;

use Jaunas\Chip8\DataType\Opcode;
use Jaunas\Chip8\Engine;
use Jaunas\Chip8\Terminal;
use Jaunas\Chip8\Work\Worker\AbstractWorker;

/**
 * Opcode FX0A
 * A key press is awaited, and then stored in VX. (Blocking Operation. All instruction halted until next key event)
 */
final class Get extends AbstractWorker
{

    /** @var Terminal */
    private $terminal;

    public function __construct(Engine $engine, Terminal $terminal)
    {
        parent::__construct($engine);
        $this->terminal = $terminal;
    }

    public function match(Opcode $opcode): bool
    {
        return $opcode->match(0xF0FF, 0xF00A);
    }

    public function execute(Opcode $opcode)
    {
        $this->engine->registers[$opcode->getX()] = $this->terminal->getPressedKey();

        $this->engine->incrementProgramCounter();
    }
}
