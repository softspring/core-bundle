<?php

namespace Softspring\CoreBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Softspring\CoreBundle\DependencyInjection\SfsCoreExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SfsCoreExtensionTest extends TestCase
{
    public function testEmptyConfig()
    {
        $extension = new SfsCoreExtension();
        $extension->load([], $container = new ContainerBuilder());

        $this->assertTrue(true);
    }

    public function testFullConfig()
    {
        $extension = new SfsCoreExtension();
        $extension->load([
            'sfs_core' => [
                'twig' => [
                    'active_for_routes_extension' => true,
                    'routing_extension' => true,
                ],
            ],
        ], $container = new ContainerBuilder());

        $this->assertTrue(true);
    }
}