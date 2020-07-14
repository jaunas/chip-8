#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Jaunas\Chip8\DependencyInjection\AddWorkerPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('services.yaml');
$containerBuilder->addCompilerPass(new AddWorkerPass());
$containerBuilder->compile();

$application = $containerBuilder->get(Application::class);
$application->run();
