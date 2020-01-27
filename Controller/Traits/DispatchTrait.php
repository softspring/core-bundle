<?php

namespace Softspring\CoreBundle\Controller\Traits;

use Softspring\CoreBundle\Event\GetResponseEventInterface;

trait DispatchTrait
{
    /**
     * @param string                    $eventName
     * @param GetResponseEventInterface $event
     */
    protected function dispatch(string $eventName, GetResponseEventInterface $event): void
    {
        $this->get('event_dispatcher')->dispatch($event, $eventName);
    }
}