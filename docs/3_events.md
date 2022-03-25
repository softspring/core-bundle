# Events

## Request event

```php
use Softspring\CoreBundle\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Request;

// dispatch event
$event = new RequestEvent($request);
$eventDispatcher->dispatch($event);

// in dispatcher get request
$request = $event->getRequest();
```

## Form event

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

## View event

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