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

## 2. Usage

### Templates

If you want to extend one of the *SeegnoBootstrapBundle* templates, you'll need to add the bundle to *Assetic Configuration*:

    # app/config.yml
    assetic:
        bundles:
            - SeegnoBootstrapBundle

### Forms

To use the *SeegnoBootstrapBundle* form theme just import it *in place*:

    {# some_view.html.twig #}
    {% form_theme form 'SeegnoBootstrapBundle:Form:layout.html.twig' %}

Or, add it globally to *Twig Configuration*:

    # app/config.yml
    twig:
        form:
            resources: ['SeegnoBootstrapBundle:Form:layout.html.twig']

### Alerts

There are two *twig functions* to help you handle the flash messages.

To render all the `FlashBag` you can include the following *twig function* anywhere on your *view*:

	{# some_view.html.twig #}
	{{ seegno_bootstrap_alerts() }}

If you need to render an *alert* individually, use:

	{# some_view.html.twig #}
	{{ seegno_bootstrap_alert('success', 'Your message here.') }}

## 3. Examples

The bundle includes some examples. Check the code on `Controller/ExampleController.php` and relative *views*.

If you want to see them on your browser, just add the following route to your routing file:

    # app/routing_dev.yml
    seegno_bootstrap_bundle:
        resource: "@SeegnoBootstrapBundle/Controller/"
        type:     annotation
        prefix:   /

---

## TODO

* Review CollectionType and ButtonType
* Better handling of "horizontal" and "inline" forms
