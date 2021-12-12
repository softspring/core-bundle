<?php

namespace Softspring\CoreBundle\Tests\Event;

use PHPUnit\Framework\TestCase;
use Softspring\CoreBundle\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\Event;

class RequestEventTest extends TestCase
{
    public function testInterfaces()
    {
        $request = new Request();
        $event = new RequestEvent($request);

        $this->assertInstanceOf(Event::class, $event);
    }

    public function testGetRequest()
    {
        $request = new Request();
        $event = new RequestEvent($request);

        $this->assertEquals($request, $event->getRequest());
    }
}