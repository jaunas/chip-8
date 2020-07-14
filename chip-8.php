#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Jaunas\Chip8\DependencyInjection\ContainerBuilder;
use Symfony\Component\Console\Application;

$containerBuilder = ContainerBuilder::create();

$application = $containerBuilder->get(Application::class);
$application->run();
