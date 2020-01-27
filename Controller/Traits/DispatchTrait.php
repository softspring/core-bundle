<?php

namespace Softspring\CoreBundle\Controller\Traits;

use Symfony\Contracts\EventDispatcher\Event;

trait DispatchTrait
{
    /**
     * @param string $eventName
     * @param Event  $event
     */
    protected function dispatch(string $eventName, Event $event): void
    {
        $this->get('event_dispatcher')->dispatch($event, $eventName);
    }
}