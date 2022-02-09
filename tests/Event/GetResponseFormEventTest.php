<?php

namespace Softspring\CoreBundle\Tests\Event;

use PHPUnit\Framework\TestCase;
use Softspring\CoreBundle\Event\GetResponseEventInterface;
use Softspring\CoreBundle\Event\GetResponseFormEvent;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\Event;

class GetResponseFormEventTest extends TestCase
{
    public function testInterfaces()
    {
        $formFactory = Forms::createFormFactory();
        $form = $formFactory->create();
        $event = new GetResponseFormEvent($form);

        $this->assertInstanceOf(GetResponseEventInterface::class, $event);
        $this->assertInstanceOf(Event::class, $event);
    }

    public function testGetForm()
    {
        $formFactory = Forms::createFormFactory();
        $form = $formFactory->create();
        $event = new GetResponseFormEvent($form);

        $this->assertEquals($form, $event->getForm());
    }

    public function testGetRequest()
    {
        $formFactory = Forms::createFormFactory();
        $form = $formFactory->create();
        $request = new Request();
        $event = new GetResponseFormEvent($form, $request);

        $this->assertEquals($request, $event->getRequest());
    }

    public function testGetResponse()
    {
        $formFactory = Forms::createFormFactory();
        $form = $formFactory->create();
        $request = new Request();
        $event = new GetResponseFormEvent($form, $request);

        $event->setResponse(null);
        $this->assertNull($event->getResponse());

        $event->setResponse($response = new Response());
        $this->assertEquals($response, $event->getResponse());
    }
}
