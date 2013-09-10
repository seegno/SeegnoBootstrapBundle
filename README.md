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

1.3. (Optional) Symlink `twbs/bootstrap` and `twbs/boostrap/fonts`. From your `web` folder:

    $ ln -s ../vendor/twbs/bootstrap bootstrap
    $ ln -s ../vendor/twbs/bootstrap/fonts fonts

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

### Navs

Navigation takes advantage of [KnpMenuBundle](https://github.com/KnpLabs/KnpMenuBundle). Use the *navigation layout* included:

    # app/config.yml
    knp_menu:
        twig:
            template: SeegnoBootstrapBundle:Nav:layout.html.twig

Or, use it on the *twig function*:

    {{ knp_menu_render('main', { 'template': 'SeegnoBootstrapBundle:Nav:layout.html.twig' }) }}

Furthermore, to make the menus easier to define we've included a custom `MenuProvider` to define the menus using `yaml`. You can define a menu as showed bellow:

    # app/config.yml
    seegno_bootstrap:
        navs:
            menus:
                main:
                    childrenAttributes: { class: 'nav nav-pills' }
                    items:
                        homepage: { label: 'Pages', route: 'homepage' }
                        about:    { label: 'About', route: 'about' }
                        blog:     { label: 'Blog', route: 'blog', extras: { 'routes': [{ pattern: '/^blog/' }] } }

The `MenuProvider` provides some menu item extras:

 * **submenu**: The key of another menu to render it as menu item children.
 * **roles**: An array of roles setted as an extra parameter that check if the users has access to certain menu item.

The `twig template` included also have some extras:

 * **include**: The template location setted as an extra parameter, i.e., `SeegnoBootstrapBundle:Example:menuitem.html.twig`

### Pagination

Pagination takes advantage of [KnpPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle) and we suggest you to use it in case you need to paginate something.

We've included two different views: a *default pagination* and a *pager*.

Added it to *KnpPaginatior Configuration*:

    # app/config.yml
    knp_paginator:
        template:
            pagination: SeegnoBootstrapBundle:Pagination:layout.html.twig

Or, just use it with the *twig function*:

    {{ knp_pagination_render(pagination, 'SeegnoBootstrapBundle:Pagination:pager.html.twig') }}

Check the examples section for more.

## 3. Examples

The bundle includes some examples. Check the code on `Controller/ExampleController.php` and relative *views*.

If you want to see them on your browser, add the following route to your routing file:

    # app/routing_dev.yml
    seegno_bootstrap_bundle:
        resource: "@SeegnoBootstrapBundle/Controller/"
        type:     annotation

And, the `seegno_bootstrap` menu:

    # app/config_dev.yml
    seegno_bootstrap:
        seegno_bootstrap_example:
            childrenAttributes: { class: 'nav nav-pills nav-stacked'}
            items:
                alerts:     { label: 'Alerts', route: 'seegno_bootstrap_alerts' }
                forms:      { label: 'Forms', route: 'seegno_bootstrap_forms' }
                navs:       { label: 'Navs', route: 'seegno_bootstrap_navs' }
                pagination: { label: 'Pagination', route: 'seegno_bootstrap_pagination' }
                something:  { extras: { include: 'SeegnoBootstrapBundle:Example:menuitem.html.twig' } }

---

## 4. Advanced

To do.
