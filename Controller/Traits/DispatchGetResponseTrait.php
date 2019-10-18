<?php

namespace Softspring\CoreBundle\Controller\Traits;

use Softspring\CoreBundle\Event\GetResponseEventInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\Event;

trait DispatchGetResponseTrait
{
    /**
     * @param string                          $eventName
     * @param GetResponseEventInterface|Event $event
     *
     * @return null|Response
     */
    protected function dispatchGetResponse(string $eventName, GetResponseEventInterface $event): ?Response
    {
        $this->get('event_dispatcher')->dispatch($event, $eventName);

        if ($event->getResponse()) {
            return $event->getResponse();
        }

        return null;
    }
}