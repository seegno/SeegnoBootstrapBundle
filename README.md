SeegnoBootstrapBundle
=====================

[Bootstrap](http://getbootstrap.com) utilities for Symfony2

---

## 1. Installation

Add the bundle to your `composer.json`:

    $ php composer.phar require seegno/boostrap-bundle dev-master

Register the bundle on `app/AppKernel.php`:

    public function registerBundles()
    {
        return array(
            // ...
            new Seegno\BootstrapBundle\SeegnoBootstrapBundle()
        );
    }
