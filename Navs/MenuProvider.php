<?php

namespace Seegno\BootstrapBundle\Navs;

use Knp\Menu\FactoryInterface;
use Knp\Menu\Provider\MenuProviderInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

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
     * @var AuthorizationCheckerInterface
     */
    protected $authorization;

    /**
     * @var array
     */
    protected $menus = array();


    /**
     * @param FactoryInterface         $factory
     * @param AuthorizationCheckerInterface $authorization
     * @param array                    $menus
     */
    public function __construct(FactoryInterface $factory, AuthorizationCheckerInterface $authorization, $menus)
    {
        $this->factory = $factory;
        $this->menus = $menus;
        $this->authorization = $authorization;
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

        $options = array_merge($menuOptions, $options);

        $menu = $this->factory->createItem($name, $options);

        // add children
        foreach ($items as $key => $itemOptions) {
            $submenu = isset($itemOptions['submenu']) ? $itemOptions['submenu'] : false;

            // handle roles
            if (isset($itemOptions['extras']['roles'])) {
                $roles = is_array($itemOptions['extras']['roles']) ? $itemOptions['extras']['roles'] : array($itemOptions['extras']['roles']);

                if (! $this->authorization->isGranted($roles)) {
                    $itemOptions['display'] = false;
                }
            }

            $menuItem = $menu->addChild($key, $itemOptions);

            // handle submenu
            if ($submenu) {
                $submenu = $this->get($submenu);

                $menuItem->setChildren($submenu->getChildren());
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
