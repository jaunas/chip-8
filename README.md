CHIP-8 Emulator
===============

This is [CHIP-8](https://en.wikipedia.org/wiki/CHIP-8) emulator written in PHP. It uses ncurses as display and keypad
input.

Currently, there are 2 working examples:
* [IBM Logo.ch8](examples/IBM%20Logo.ch8) - looks like it works perfectly fine
* [Zero Demo.ch8](examples/Zero%20Demo.ch8) - it works, but not sure if properly

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