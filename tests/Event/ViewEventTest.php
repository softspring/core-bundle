<?php

namespace Softspring\CoreBundle\Tests\Event;

use PHPUnit\Framework\TestCase;
use Softspring\CoreBundle\Event\ViewEvent;
use Symfony\Contracts\EventDispatcher\Event;

class ViewEventTest extends TestCase
{
    public function testInterfaces()
    {
        $event = new ViewEvent(new \ArrayObject());

        $this->assertInstanceOf(Event::class, $event);
    }

    public function testGetDataEmpty()
    {
        $event = new ViewEvent(new \ArrayObject());
        $this->assertEquals([], (array) $event->getData());
    }

    public function testGetData()
    {
        $event = new ViewEvent(new \ArrayObject(['test' => 1, 'other' => 'yes']));
        $this->assertEquals(['test' => 1, 'other' => 'yes'], (array) $event->getData());
    }
}
