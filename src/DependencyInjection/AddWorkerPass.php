<?php

namespace Jaunas\Chip8\DependencyInjection;

use Jaunas\Chip8\Work\Dispatcher;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddWorkerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $workers = $container->findTaggedServiceIds('dispatcher.worker');
        $dispatcher = $container->getDefinition(Dispatcher::class);

        foreach ($workers as $id => $tags) {
            $reference = new Reference($container->getDefinition($id)->getClass());
            $dispatcher->addMethodCall('addWorker', [$reference]);
        }
    }
}