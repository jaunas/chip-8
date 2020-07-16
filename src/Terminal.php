<?php

namespace Jaunas\Chip8;

use Jaunas\Chip8\DataType\Screen;

class Terminal
{

    /** @var resource */
    private $screen;

    private $isOpen = false;

    public function open()
    {
        if (!$this->isOpen) {
            ncurses_init();
            ncurses_noecho();
            ncurses_curs_set(0);
            ncurses_refresh();

            $this->createScreenWindow();

            $this->isOpen = true;
        }
    }

    private function createScreenWindow()
    {
        $this->screen = ncurses_newwin(Screen::HEIGHT + 2, (Screen::WIDTH*2) + 2, 0, 0);
        ncurses_wborder($this->screen, 0, 0, 0, 0, 0, 0, 0, 0);
        ncurses_wrefresh($this->screen);
    }

    public function close()
    {
        if ($this->isOpen) {
            ncurses_end();
            $this->screen = null;
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    public function refresh(Engine $engine)
    {
        $this->refreshScreen($engine->screen);
    }

    private function refreshScreen(Screen $screen)
    {
        if ($this->isOpen) {
            $y = 0;
            foreach ($screen->getLines() as $line) {
                ncurses_wmove($this->screen, $y + 1, 1);
                ncurses_wattron($this->screen, 0);
                ncurses_waddstr($this->screen, $this->convertLine($line));
                ncurses_wattroff($this->screen, 0);

                $y++;
            }

            ncurses_wrefresh($this->screen);
        }
    }

    private function convertLine(string $line): string
    {
        return str_replace(["\x0", "\x1"], ["  ", "██"], $line);
    }

    public function getPressedKey(): int
    {
        return $this->isOpen ? ncurses_getch() : 0;
    }
}
