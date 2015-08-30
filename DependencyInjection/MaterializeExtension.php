<?php

namespace Evheniy\MaterializeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;
use Evheniy\JqueryBundle\Helper\CdnHelper;

/**
 * Class MaterializeExtension
 *
 * @package Evheniy\MaterializeBundle\DependencyInjection
 */
class MaterializeExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);
        $config['local_cdn'] = CdnHelper::createInstance()->filterCdn($config['local_cdn']);
        $container->setParameter('materialize', $config);
        $container->setParameter('materialize.local_js', $config['local_js']);
        $container->setParameter('materialize.local_fonts_dir', $config['local_fonts_dir']);
        $container->setParameter('materialize.local_css', $config['local_css']);
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'materialize';
    }
}
