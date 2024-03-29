<?php

namespace Softspring\CoreBundle\Controller\Traits;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * @deprecated use softspring/events component
 */
trait DispatchTrait
{
    protected function dispatch(string $eventName, Event $event): void
    {
        if (empty($this->eventDispatcher)) {
            @trigger_error('This method will require eventDispatcher property', E_USER_DEPRECATED);
            $this->get('event_dispatcher')->dispatch($event, $eventName);
        } else {
            $this->eventDispatcher->dispatch($event, $eventName);
        }
    }
}
