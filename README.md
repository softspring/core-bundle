# SfsCoreBundle

[![Latest Stable Version](https://poser.pugx.org/softspring/core-bundle/v/stable.svg)](https://packagist.org/packages/softspring/core-bundle)
[![Latest Unstable Version](https://poser.pugx.org/softspring/core-bundle/v/unstable.svg)](https://packagist.org/packages/softspring/core-bundle)
[![License](https://poser.pugx.org/softspring/core-bundle/license.svg)](https://packagist.org/packages/softspring/core-bundle)
[![Total Downloads](https://poser.pugx.org/softspring/core-bundle/downloads)](https://packagist.org/packages/softspring/core-bundle)
[![Build status](https://app.travis-ci.com/github/softspring/core-bundle.svg?branch=master)](https://app.travis-ci.com/github/softspring/core-bundle)

The SfsCoreBundle adds some general facilities and extra features to Symfony projects.

## Installation

### Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require softspring/core-bundle
```

## Facilities

### Base template

There is a general purpose twig base template that provides a common structure:

```twig
{# templates/base.html.twig #}
{% extends '@SfsCore/base.html.twig' %} 
```

Also you can define as optional in your bundles: 

```twig
{% extends ['@SfsCore/base.html.twig', 'base.html.twig'] %} 
```

### Events

#### Request event

```php
use Softspring\CoreBundle\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Request;

// dispatch event
$event = new RequestEvent($request);
$eventDispatcher->dispatch($event);

// in dispatcher get request
$request = $event->getRequest();
```

#### Form event

```php
use Softspring\CoreBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\Request;

// dispatch event
$event = new FormEvent($form, $request);
$eventDispatcher->dispatch($event);

// in dispatcher get request and form
$request = $event->getRequest();
$form = $event->getForm();
```

#### View event

```php
use Softspring\CoreBundle\Event\ViewEvent;
use Symfony\Component\HttpFoundation\Request;

// in controller, prepare the view data
$viewData = new \ArrayObject([
    'products' => $products,
    'form' => $form->createView(),
]);

// dispatch event (also in controller)
$event = new ViewEvent($viewData);
$eventDispatcher->dispatch($event);

// in dispatcher get data or append values
$data = $event->getData();
$event->getData()['more'] = 'more-data';

// in controller again
return $this->render('products.html.twig', $viewData->getArrayCopy());
```

### Extensible templating variables

This bundle provides and extensible "app" template variable, that allows appending values to it.

The following example appends a "store" variable to the global "app" object to use in twig templates:

```php
<?php

namespace App\EventListener;

use Softspring\CoreBundle\Twig\ExtensibleAppVariable;
use Symfony\Bridge\Twig\AppVariable;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class StoreRequestListener implements EventSubscriberInterface
{
    /**
     * @var AppVariable
     */
    protected $twigAppVariable;

    /**
     * @param AppVariable $twigAppVariable
     */
    public function __construct(AppVariable $twigAppVariable)
    {
        if (!$twigAppVariable instanceof ExtensibleAppVariable) {
            throw new InvalidConfigurationException('You must configure SfsCoreBundle to extend twig app variable');
        }

        $this->twigAppVariable = $twigAppVariable;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                ['onRequestGetStore', 30], // router listener has 32
            ],
        ];
    }
    
    public function onRequestGetStore(RequestEvent $event)
    {
        $this->twigAppVariable->setStore('uk');
    }
}
```

```twig
{# your twig template #}
{{ app.store }} {# returns uk #}
```

## Aditional features

### Redirect exception

**Enable feature**

```yaml
{# config/packages/sfs_core.yaml #}
sfs_core:
    http:
        catch_http_redirect_exception: true        
```

**Usage**

```php
use Softspring\CoreBundle\Http\HttpRedirectException;
use Symfony\Component\HttpFoundation\RedirectResponse;

throw new HttpRedirectException(new RedirectResponse('/redirect-url'));        
```

Automatically, a listener catches the exception and sets the response.

### Twig functions

#### active_for_routes_extension

This extension provides a function that returns an active class for matching routes. 

This is useful to create menus, options or tabs with active marks.

**Enable feature**

```yaml
{# config/packages/sfs_core.yaml #}
sfs_core:
    twig:
        active_for_routes_extension: true        
```

**Usage**

```twig
<a href="{{ url('admin_products_list') }}" class="{{ activeForRoutes('admin_products_') }}">Products</a> {# this link will have an "active" class when the current route matches with "admin_products_" #}        
<a href="{{ url('admin_products_list') }}" class="{{ activeForRoutes('admin_products_', checkSomeVariable == true) }}">Products</a> {# also you can add an extra boolean expression #}        
<a href="{{ url('admin_products_list') }}" class="{{ activeForRoutes('admin_products_', null, 'my-active-class') }}">Products</a> {# or change the "active" class with your "my-active-class" #}        
```

#### routing_extension

This extension provides a route_defined function. 

This is useful for bundles with enabling features.

**Enable feature**

```yaml
{# config/packages/sfs_core.yaml #}
sfs_core:
    twig:
        routing_extension: true        
```

**Usage**

```twig
{# a bundle twig template #}
{% if route_defined('sfs_user_register') %}
    <a href="{{ url('sfs_user_register') }}" class="btn btn-secondary btn-block">Sign up</a>
{% endif %}
```

## License

This bundle is under the MIT license. See the complete license in the bundle LICENSE file.