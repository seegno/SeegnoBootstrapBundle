<?php

namespace Seegno\BootstrapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('seegno_bootstrap');

        $rootNode
            ->children()
                ->arrayNode('alerts')
                    ->prototype('scalar')->end()
                        ->defaultValue(array('success', 'info', 'warning', 'danger'))
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
