<?php

namespace Jaunas\Chip8;

use Jaunas\Chip8\DataType\Screen;
use wapmorgan\NcursesObjects\Ncurses;
use wapmorgan\NcursesObjects\Window;

class Terminal
{

    private const KEY_TIMEOUT = 100;

    /** @var Ncurses */
    private $ncurses;

    /** @var Window */
    private $window;

    public function __construct()
    {
        $this->ncurses = new Ncurses();

        $this->ncurses
            ->setEchoState(false)
            ->setNewLineTranslationState(true)
            ->setCursorState(Ncurses::CURSOR_INVISIBLE)
            ->refresh();

        $mainWindow = new Window();
        $mainWindow
            ->border()
            ->title('Haju!')
            ->refresh();

        $this->window = Window::createCenteredOf($mainWindow, 64, 32);
        $this->window
            ->border()
            ->refresh()
        ;
    }

    public function refreshScreen(Screen $screen)
    {
        $y = 0;
        foreach ($screen->getLines() as $line) {
            $this->window
                ->moveCursor(0, $y)
                ->drawStringHere($this->convertLine($line));
        }

        $this->window->refresh();
    }

    private function convertLine(string $line): string
    {
        return str_replace(["\x0", "\x1"], [" ", "█"], $line);
    }

    public function getPressedKey(): int
    {
        return $this->ncurses->getCh();
    }
}