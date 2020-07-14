<?php

namespace Jaunas\Chip8\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder as DIContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class ContainerBuilder
{
    public static function create(): DIContainerBuilder
    {
        $containerBuilder = new DIContainerBuilder();
        $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/../..'));
        $loader->load('services.yaml');
        $containerBuilder->addCompilerPass(new AddWorkerPass());
        $containerBuilder->compile();

        return $containerBuilder;
    }
}