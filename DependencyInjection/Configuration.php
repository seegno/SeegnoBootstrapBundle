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
                ->booleanNode('forms')
                    ->defaultTrue()
                ->end()

                ->arrayNode('alerts')
                    ->prototype('scalar')->end()
                    ->treatFalseLike(array())
                    ->defaultValue(array('success', 'info', 'warning', 'danger'))
                ->end()

                ->arrayNode('navs')
                    ->children()
                        ->arrayNode('options')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('currentClass')->defaultValue('active')->end()
                                ->scalarNode('ancestorClass')->defaultValue('active')->end()
                                ->booleanNode('allow_safe_labels')->defaultValue(true)->end()
                            ->end()
                        ->end()

                        ->arrayNode('menus')
                            ->prototype('array')
                                ->children()
                                    ->arrayNode('childrenAttributes')
                                        ->beforeNormalization()->always(function($v) { return $this->fixKeys($v); })->end()
                                        ->prototype('scalar')->end()
                                    ->end()
                                    ->arrayNode('attributes')
                                        ->beforeNormalization()->always(function($v) { return $this->fixKeys($v); })->end()
                                        ->prototype('scalar')->end()
                                    ->end()
                                    ->arrayNode('items')
                                        ->prototype('array')
                                            ->children()
                                                ->scalarNode('label')->end()
                                                ->scalarNode('route')->end()
                                                ->arrayNode('routeParameters')
                                                    ->prototype('scalar')->end()
                                                ->end()
                                                ->scalarNode('uri')->defaultValue('#')->end()
                                                ->scalarNode('submenu')->end()
                                                ->arrayNode('childrenAttributes')
                                                    ->prototype('scalar')->end()
                                                ->end()
                                                ->arrayNode('attributes')
                                                    ->beforeNormalization()->always(function($v) { return $this->fixKeys($v); })->end()
                                                    ->prototype('scalar')->end()
                                                ->end()
                                                ->arrayNode('linkAttributes')
                                                    ->beforeNormalization()->always(function($v) { return $this->fixKeys($v); })->end()
                                                    ->prototype('scalar')->end()
                                                ->end()
                                                ->arrayNode('extras')
                                                    ->defaultValue(array('safe_label' => true))
                                                    ->prototype('variable')->end()
                                                ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()

            ->end()
        ;

        return $treeBuilder;
    }

    /**
     * Convert underscores to dashes
     *
     * @param  string $v
     * @return string
     */
    private function fixKeys($v)
    {
        foreach ($v as $key => $value) {
            if (false !== stripos($key, '_')) {
                $v[str_replace('_', '-', $key)] = $v[$key];
                unset($v[$key]);
            }
        };

        return $v;
    }
}
