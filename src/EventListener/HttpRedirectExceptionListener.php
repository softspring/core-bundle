<?php

namespace Softspring\CoreBundle\EventListener;

use Softspring\CoreBundle\Http\HttpRedirectException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class HttpRedirectExceptionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException'],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $e = $event->getThrowable();

        if (!$e instanceof HttpRedirectException) {
            return;
        }

        $event->setResponse($e->getResponse());
    }
}
