MaterializeBundle
=================

[![Latest Stable Version](https://poser.pugx.org/evheniy/materialize-bundle/v/stable)](https://packagist.org/packages/evheniy/materialize-bundle) [![Total Downloads](https://poser.pugx.org/evheniy/materialize-bundle/downloads)](https://packagist.org/packages/evheniy/materialize-bundle) [![Latest Unstable Version](https://poser.pugx.org/evheniy/materialize-bundle/v/unstable)](https://packagist.org/packages/evheniy/materialize-bundle) [![License](https://poser.pugx.org/evheniy/materialize-bundle/license)](https://packagist.org/packages/evheniy/materialize-bundle)

[![Build Status](https://travis-ci.org/evheniy/MaterializeBundle.svg)](https://travis-ci.org/evheniy/MaterializeBundle)

This bundle provides Materialize in Symfony2 from CDN cdnjs

Installation
------------

    $ composer require evheniy/materialize-bundle "1.*"

Or add to composer.json

    "evheniy/materialize-bundle": "1.*"

AppKernel:

    public function registerBundles()
        {
            $bundles = array(
                ...
                new Evheniy\MaterializeBundle\MaterializeBundle(),
            );
            ...

config.yml:

    #MaterializeBundle
    materialize: ~

    or

    #MaterializeBundle
    materialize:
        local_js: '@AppBundle/Resources/public/js/materialize.min.js'
        local_fonts_dir: '@AppBundle/Resources/public/fonts/'
        local_css: '@AppBundle/Resources/public/css/materialize.min.css'
        local_cdn: 'cdn.domain.com'
        version: 0.97.0
        html5: true
        async: false

And Assetic Configuration in config.yml:

    #Assetic Configuration
    assetic:
        bundles: [ MaterializeBundle ]

Add this string to your layout (styles and js)

    <html>
        <head>
        ...

        {%- include "MaterializeBundle:Materialize:css.html.twig" -%}
        </head>
        <body>
        ...

        {%- include "MaterializeBundle:Materialize:js.html.twig" -%}
        </body>
    </html>
The last step

    app/console assetic:dump --env=prod --no-debug


Documentation
-------------

You can change Materialize version:

    materialize:
        version: 0.97.0
        
You can set Materialize local version (it helps if cdn doesn't work).

    materialize:
        local_js: '@AppBundle/Resources/public/js/materialize.min.js'

Default value: '@MaterializeBundle/Resources/public/js/materialize.min.js'

    materialize:
        local_fonts_dir: '@AppBundle/Resources/public/fonts/'

Default value: '@MaterializeBundle/Resources/public/fonts/' 
 
    materialize:
        local_css: '@AppBundle/Resources/public/css/materialize.min.css'

Default value: '@MaterializeBundle/Resources/public/css/materialize.min.css'

You can set local CDN:

    materialize:
        local_cdn: 'cdn.domain.com'


You can use old html version:

    materialize:
        html5: false

Default value: true. If false script will be with type="text/javascript"

You can use async loading:

    materialize:
        async: true

Default value: false. If true script will be with async="async"


License
-------

This bundle is under the [MIT][3] license.

[Документация на русском языке][1]

[Materialize][2]

[1]:  http://makedev.org/articles/symfony/bundles/materialize_bundle.html
[2]:  http://materializecss.com/
[3]:  https://github.com/evheniy/MaterializeBundle/blob/master/Resources/meta/LICENSE
