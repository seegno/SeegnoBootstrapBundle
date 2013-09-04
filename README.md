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

There are two *twig functions* to help you handle the flash messages:

###### All at once

Render all the `FlashBag` you can include the following *twig function* anywhere on your *view*:

	{# some_view.html.twig #}
	{{ seegno_bootstrap_alerts() }}

By default will render the *keys* "success", "info", "warning" and "danger" flashes. You can change this on the *SeegnoBoostrap Configuration*:

    # app/config.yml
    seegno_bootstrap:
        alerts: ["success", "info", "warning", "danger"]

Or, if you want to catch any *flash*, turn the *strict* option off:

    {# some_view.html.twig #}
    {{ seegno_bootstrap_alerts(false) }}

###### Just what you want

Render a *flash* individually (this will lookup for the given key on the *FlashBag*):

    {# some_view.html.twig #}
    {{ seegno_bootstrap_alert('success') }}

You can also use this *twig function* adding a message (without adding it to the *FlashBag*):

	{# some_view.html.twig #}
	{{ seegno_bootstrap_alert('success', 'Your message here') }}

### Pagination

Pagination takes advantages of [KnpPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle) and we suggest you to use it.

We've included two different views: a *default pagination* and a *pager*.

Added it to *KnpPaginatior Configuration*:

    # app/config.yml
    knp_paginator:
        template:
            pagination: SeegnoBootstrapBundle:Pagination:layout.html.twig

Or, just use it with the *twig function*:

    {{ knp_pagination_render(pagination, 'SeegnoBootstrapBundle:Pagination:pager.html.twig') }}

## 3. Examples

The bundle includes some examples. Check the code on `Controller/ExampleController.php` and relative *views*.

If you want to see them on your browser, just add the following route to your routing file:

    # app/routing_dev.yml
    seegno_bootstrap_bundle:
        resource: "@SeegnoBootstrapBundle/Controller/"
        type:     annotation

---

## TODO

* Review CollectionType and ButtonType
* Better handling of "horizontal" and "inline" forms
