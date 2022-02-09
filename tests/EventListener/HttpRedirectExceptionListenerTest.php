<?php

namespace Softspring\CoreBundle\Tests\EventListener;

use PHPUnit\Framework\TestCase;
use Softspring\CoreBundle\EventListener\HttpRedirectExceptionListener;
use Softspring\CoreBundle\Http\HttpRedirectException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class HttpRedirectExceptionListenerTest extends TestCase
{
    public function testSubscribedEvents()
    {
        $this->assertArrayHasKey(KernelEvents::EXCEPTION, HttpRedirectExceptionListener::getSubscribedEvents());
    }

    public function testIgnoredException()
    {
        $listener = new HttpRedirectExceptionListener();

        $kernel = $this->getMockBuilder(HttpKernel::class)->disableOriginalConstructor()->getMock();
        $request = new Request();
        $e = new \Exception();
        $event = new ExceptionEvent($kernel, $request, HttpKernelInterface::MASTER_REQUEST, $e);

        $listener->onKernelException($event);

        $this->assertNull($event->getResponse());
    }

    public function testExpectedException()
    {
        $listener = new HttpRedirectExceptionListener();

        $kernel = $this->getMockBuilder(HttpKernel::class)->disableOriginalConstructor()->getMock();
        $request = new Request();
        $response = new RedirectResponse('/');
        $e = new HttpRedirectException($response);
        $event = new ExceptionEvent($kernel, $request, HttpKernelInterface::MASTER_REQUEST, $e);

        $listener->onKernelException($event);

        $this->assertEquals($response, $event->getResponse());
    }
}
