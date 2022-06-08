<?php

namespace Softspring\CoreBundle\Controller\Traits;

use Softspring\CoreBundle\Event\GetResponseEventInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * @deprecated use softspring/events component
 */
trait DispatchGetResponseTrait
{
    use DispatchTrait;

    /**
     * @param GetResponseEventInterface|Event $event
     */
    protected function dispatchGetResponse(string $eventName, GetResponseEventInterface $event): ?Response
    {
        $this->dispatch($eventName, $event);

        if ($event->getResponse()) {
            return $event->getResponse();
        }

        return null;
    }
}
