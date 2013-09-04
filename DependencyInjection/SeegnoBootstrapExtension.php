<?php

namespace Seegno\BootstrapBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * SeegnoBootstrapExtension
 */
class SeegnoBootstrapExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->registerAlertsConfiguration($config['alerts'], $container);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));

        $loader->load('form.yml');
        $loader->load('twig.yml');
    }

    /**
     * Register alerts configuration as container parameter
     *
     * @param  array            $config
     * @param  ContainerBuilder $container
     *
     * @return SeegnoBootstrapExtension
     */
    public function registerAlertsConfiguration(array $config, ContainerBuilder $container)
    {
        $container->setParameter('seegno_boostrap.alerts', $config);

        return $this;
    }
}
