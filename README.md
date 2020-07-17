CHIP-8 Emulator
===============

This is [CHIP-8](https://en.wikipedia.org/wiki/CHIP-8) emulator written in PHP. It uses ncurses as display and keypad
input.

Currently, there are 3 working examples fetched from [here](https://github.com/dmatlack/chip8):
* [IBM Logo.ch8](examples/IBM%20Logo.ch8)
* [Zero Demo.ch8](examples/Zero%20Demo.ch8)
* [Maze.ch8](examples/Maze.ch8)

Installation
------------

1. Clone repository
2. Run `composer install`

Usage
-----

Run `php chip-8.php` for usage information.

Testing
-------

There are only few tests at the moment. They can be run with command: `vendor/bin/runtests tests/`

TODO
----

* Finish unit tests
* Think about integration tests
* Think about refactoring emulator and engine classes
* Add more tested examples, especially with keypad usage
* Handle Ctrl-C
* Debugging tool
  * Translate code to pseudocode - add json with rom description
  * Current state shown in separate window
  * Sprite preview