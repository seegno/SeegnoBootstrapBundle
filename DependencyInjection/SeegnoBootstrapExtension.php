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

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));

        if ($config['forms']) {
            $loader->load('forms.yml');
        }

        if ($config['alerts']) {
            $container->setParameter('seegno_boostrap.alerts', $config['alerts']);

            $loader->load('alerts.yml');
        }

        if (isset($config['navs'])) {
            $container->setParameter('knp_menu.renderer.twig.options', $config['navs']['options']);
            $container->setParameter('seegno_bootstrap.navs.menus', $config['navs']['menus']);

            $loader->load('navs.yml');
        }
    }
}
