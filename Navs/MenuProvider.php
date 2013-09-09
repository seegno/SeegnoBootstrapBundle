<?php

namespace Seegno\BootstrapBundle\Navs;

use Knp\Menu\FactoryInterface;
use Knp\Menu\Provider\MenuProviderInterface;

/**
 * MenuProvider
 */
class MenuProvider implements MenuProviderInterface
{
    /**
     * @var FactoryInterface
     */
    protected $factory = null;

    /**
     * @var array
     */
    protected $menus = array();


    /**
     * @param FactoryInterface $factory
     * @param array            $menus
     */
    public function __construct(FactoryInterface $factory, $menus)
    {
        $this->factory = $factory;
        $this->menus = $menus;
    }

    /**
     * Retrieves a menu by it's name
     *
     * @param string $name
     * @param array  $options
     *
     * @return \Knp\Menu\ItemInterface
     * @throws \InvalidArgumentException If the menu does not exists
     */
    public function get($name, array $options = array())
    {
        if (! $this->has($name, $options)) {
            throw new \InvalidArgumentException(sprintf('The menu "%s" is not defined.', $name));
        }

        $menuOptions = $this->menus[$name];
        $items = $menuOptions['items'];
        // unset($menuOptions['items']);

        $options = array_merge($menuOptions, $options);

        $menu = $this->factory->createItem($name, $options);

        foreach ($items as $key => $itemOptions) {
            $submenu = isset($itemOptions['submenu']) ? $itemOptions['submenu'] : false;
            // unset($itemOptions['submenu']);

            $menuItem = $menu->addChild($key, $itemOptions);

            // handle submenu
            if ($submenu) {
                // Add caret
                $menuItem->setLabel($menuItem->getLabel() . ' <span class="caret"></span>');

                // Add attributes
                $menuItem->setAttribute('class', $menuItem->getAttribute('class', '') . ' dropdown');
                $menuItem->setLinkAttribute('class', trim($menuItem->getLinkAttribute('class', '') . ' dropdown-toggle'));
                $menuItem->setLinkAttribute('data-toggle', trim($menuItem->getLinkAttribute('data-toggle', '') . ' dropdown'));

                // Create and set the submenu children
                $submenu = $this->get($submenu);

                $menuItem->setChildren($submenu->getChildren());
                $menuItem->setChildrenAttribute('class', 'dropdown-menu');
            }
        }

        return $menu;
    }

    /**
     * Checks whether a menu exists in this provider
     *
     * @param string $name
     * @param array $options
     * @return bool
     */
    public function has($name, array $options = array())
    {
        return isset($this->menus[$name]);
    }
}
