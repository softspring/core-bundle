<?php

namespace Softspring\CoreBundle\Tests\Controller\Traits;

use Psr\EventDispatcher\EventDispatcherInterface;
use Softspring\CoreBundle\Controller\Traits\DispatchTrait;
use Symfony\Contracts\EventDispatcher\Event;

class DispatchTraitClass
{
    use DispatchTrait;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * DispatchTraitClass constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    protected function get(): EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }

    public function doDispatch(string $eventName, Event $event)
    {
        $this->dispatch($eventName, $event);
    }
}