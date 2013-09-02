SeegnoBootstrapBundle
=====================

[Bootstrap](http://getbootstrap.com) utilities for Symfony2

---

## 1. Installation

1.1. Add the bundle to your `composer.json`:

    $ php composer.phar require seegno/boostrap-bundle dev-master

1.2. Register the bundle on `app/AppKernel.php`:

    public function registerBundles()
    {
        return array(
            // ...
            new Seegno\BootstrapBundle\SeegnoBootstrapBundle()
        );
    }

1.3. (Optional) Symlink `twbs/bootstrap`. From your `web` folder:

    $ ln -s ../vendor/twbs/bootstrap bootstrap

## Usage

### Templates

If you want to extend one of the *SeegnoBootstrapBundle* templates, you'll need to add the bundle to *Assetic Configuration*:

    # app/config.yml
    assetic:
        bundles:
            - SeegnoBootstrapBundle
