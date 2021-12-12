<?php

namespace Softspring\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
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

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config/services'));

        $container->setParameter('sfs_core.locales', $config['locales']);

        if ($config['twig']['active_for_routes_extension']['enabled']) {
            $loader->load('twig_active_for_routes_extension.yaml');
        }

        if ($config['twig']['date_span_extension']['enabled']) {
            $loader->load('date_span_extension.yaml');
        }

        if ($config['twig']['instanceof_extension']['enabled']) {
            $loader->load('instanceof_extension.yaml');
        }

        if ($config['twig']['encore_entry_sources_extension']['enabled']) {
            if (!interface_exists('Symfony\WebpackEncoreBundle\Asset\EntrypointLookupInterface')) {
                throw new InvalidConfigurationException('encore_entry_sources_extension requires symfony/webpack-encore-bundle');
            }
            $container->setParameter('sfs_core.encore_entry_sources.public_path', $config['twig']['encore_entry_sources_extension']['public_path']);
            $loader->load('encore_entry_sources_extension.yaml');
        }

        if ($config['twig']['routing_extension']['enabled']) {
            $loader->load('twig_routing_extension.yaml');
        }

        if ($config['http']['catch_http_redirect_exception']['enabled']) {
            $loader->load('catch_http_redirect_exception.yaml');
        }
    }
}