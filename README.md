# SfsCoreBundle

[![Latest Stable Version](https://poser.pugx.org/softspring/core-bundle/v/stable.svg)](https://packagist.org/packages/softspring/core-bundle)
[![Latest Unstable Version](https://poser.pugx.org/softspring/core-bundle/v/unstable.svg)](https://packagist.org/packages/softspring/core-bundle)
[![License](https://poser.pugx.org/softspring/core-bundle/license.svg)](https://packagist.org/packages/softspring/core-bundle)
[![Total Downloads](https://poser.pugx.org/softspring/core-bundle/downloads)](https://packagist.org/packages/softspring/core-bundle)
[![Build status](https://travis-ci.com/softspring/core-bundle.svg?branch=master)](https://app.travis-ci.com/github/softspring/core-bundle)

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

## License

This bundle is under the MIT license. See the complete license in the bundle LICENSE file.