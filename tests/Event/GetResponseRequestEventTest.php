<?php

namespace Softspring\CoreBundle\Tests\Event;

use PHPUnit\Framework\TestCase;
use Softspring\CoreBundle\Event\GetResponseEventInterface;
use Softspring\CoreBundle\Event\GetResponseRequestEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\Event;

class GetResponseRequestEventTest extends TestCase
{
    public function testInterfaces()
    {
        $request = new Request();
        $event = new GetResponseRequestEvent($request);

        $this->assertInstanceOf(GetResponseEventInterface::class, $event);
        $this->assertInstanceOf(Event::class, $event);
    }

    public function testGetRequest()
    {
        $request = new Request();
        $event = new GetResponseRequestEvent($request);

        $this->assertEquals($request, $event->getRequest());
    }

    public function testGetResponse()
    {
        $request = new Request();
        $event = new GetResponseRequestEvent($request);

        $event->setResponse(null);
        $this->assertNull($event->getResponse());

        $event->setResponse($response = new Response());
        $this->assertEquals($response, $event->getResponse());
    }
}
