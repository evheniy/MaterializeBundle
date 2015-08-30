<?php

namespace Evheniy\MaterializeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Evheniy\MaterializeBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('materialize');
        $rootNode
            ->children()
                ->scalarNode('version')->defaultValue('0.97.0')->end()
                ->scalarNode('local_cdn')->defaultValue('')->end()
                ->scalarNode('local_js')->defaultValue('@MaterializeBundle/Resources/public/js/materialize.min.js')->end()
                ->scalarNode('local_fonts_dir')->defaultValue('@MaterializeBundle/Resources/public/fonts/')->end()
                ->scalarNode('local_css')->defaultValue('@MaterializeBundle/Resources/public/css/materialize.min.css')->end()
                ->booleanNode('html5')->defaultTrue()->end()
                ->booleanNode('async')->defaultFalse()->end()
            ->end();

        return $treeBuilder;
    }
}