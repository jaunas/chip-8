<?php

namespace Jaunas\Chip8;

use Jaunas\Chip8\DataType\Screen;

class Terminal
{

    /** @var resource */
    private $window;

    public function __construct()
    {
        ncurses_init();
        ncurses_noecho();
        ncurses_curs_set(0);
        ncurses_refresh();
        $this->window = ncurses_newwin(Screen::HEIGHT + 2, Screen::WIDTH + 2, 0, 0);
        ncurses_wborder($this->window, 0, 0, 0, 0, 0, 0, 0, 0);
        ncurses_wrefresh($this->window);
    }

    public function __destruct()
    {
        ncurses_end();
    }

    public function refreshScreen(Screen $screen)
    {
        $y = 0;
        foreach ($screen->getLines() as $line) {
            ncurses_wmove($this->window, $y+1, 1);
            ncurses_wattron($this->window, 0);
            ncurses_waddstr($this->window, $this->convertLine($line));
            ncurses_wattroff($this->window, 0);

            $y++;
        }

        ncurses_wrefresh($this->window);
    }

    private function convertLine(string $line): string
    {
        return str_replace(["\x0", "\x1"], [" ", "█"], $line);
    }

    public function getPressedKey(): int
    {
        return ncurses_getch();
    }
}