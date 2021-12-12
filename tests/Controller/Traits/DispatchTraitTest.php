<?php

namespace Softspring\CoreBundle\Tests\Controller\Traits;

use PHPUnit\Framework\TestCase;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\EventDispatcher\Event;

class DispatchTraitTest extends TestCase
{
    public function test()
    {
        $eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $eventDispatcher->expects($this->once())->method('dispatch');
        $trait = new DispatchTraitClass($eventDispatcher);
        $trait->doDispatch('testEvent', new Event());
    }
}
