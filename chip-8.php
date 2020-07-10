#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Jaunas\Chip8\Command\Run;
use Jaunas\Chip8\Command\Test;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Run());
$application->add(new Test());
$application->run();
