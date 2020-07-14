<?php

namespace Jaunas\Chip8\Tests;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TestCase extends PHPUnitTestCase
{
    /** @var ContainerBuilder */
    protected $container;

    protected function setUp(): void
    {
        $this->container = \Jaunas\Chip8\DependencyInjection\ContainerBuilder::create();
    }
}
