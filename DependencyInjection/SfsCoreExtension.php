<?php

namespace Softspring\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class SfsCoreExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));

        $container->setParameter('sfs_core.locales', $config['locales']);

        if ($config['twig']['active_for_routes_extension']['enabled']) {
            $loader->load('twig_active_for_routes_extension.yaml');
        }

        if ($config['twig']['date_span_extension']['enabled']) {
            $loader->load('date_span_extension.yaml');
        }

        if ($config['twig']['routing_extension']['enabled']) {
            $loader->load('twig_routing_extension.yaml');
        }

        if ($config['http']['catch_http_redirect_exception']['enabled']) {
            $loader->load('catch_http_redirect_exception.yaml');
        }
    }
}