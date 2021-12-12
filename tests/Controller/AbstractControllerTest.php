<?php

namespace Softspring\CoreBundle\Tests\Controller;

use PHPUnit\Framework\TestCase;
use Softspring\CoreBundle\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Response;

class AbstractControllerTest extends TestCase
{
    public function testSubscribedServices()
    {
        $controller = new TestController();

        $this->assertContains('event_dispatcher', $controller::getSubscribedServices());
    }

//    public function testGetEntityManagerDefault()
//    {
//        // get protected method
//        $class = new \ReflectionClass(TestController::class);
//        $method = $class->getMethod('getEntityManager');
//        $method->setAccessible(true);
//
//        // prepare test
//        $em = $this->getMockBuilder('Doctrine\ORM\EntityManager')->onlyMethods([])->disableOriginalConstructor()->getMock();
//        $em->expects($this->any())->method('create')->will($this->returnValue($em));
//        $doctrine = $this->getMockBuilder('Doctrine\Persistence\ManagerRegistry')->onlyMethods(['getManager'])->getMock();
//        $controller = $this->getMockBuilder(TestController::class)->onlyMethods(['getDoctrine'])->getMock();
//        $controller->expects($this->any())->method('getDoctrine')->will($this->returnValue($doctrine));
//        $doctrine->expects($this->once())->method('getManager')->with($this->equalTo(null))->will($this->returnValue($em));
//
//        // test
//        $this->assertEquals($em, $method->invoke($controller));
//    }

    public function testDispatchGetResponseEventWithoutResponse()
    {
        // get protected method
        $class = new \ReflectionClass(TestController::class);
        $method = $class->getMethod('dispatchGetResponse');
        $method->setAccessible(true);

        // prepare test
        $controller = new TestController();
        $eventDispatcher = $this->getMockBuilder(EventDispatcher::class)->getMock();
        $container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerInterface')->getMock();
        $controller->setContainer($container);
        $container->expects($this->once())->method('get')->with($this->equalTo('event_dispatcher'))->will($this->returnValue($eventDispatcher));

        // test
        $event = new GetResponseEvent();
        $this->assertEquals(null, $method->invoke($controller, 'event.name', $event));
    }

    public function testDispatchGetResponseEventWithResponse()
    {
        // get protected method
        $class = new \ReflectionClass(TestController::class);
        $method = $class->getMethod('dispatchGetResponse');
        $method->setAccessible(true);

        // prepare test
        $controller = new TestController();
        $eventDispatcher = $this->getMockBuilder(EventDispatcher::class)->getMock();
        $container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerInterface')->getMock();
        $controller->setContainer($container);
        $container->expects($this->once())->method('get')->with($this->equalTo('event_dispatcher'))->will($this->returnValue($eventDispatcher));

        // test
        $event = new GetResponseEvent();
        $event->setResponse($response = new Response());
        $this->assertEquals($response, $method->invoke($controller, 'event.name', $event));
    }
}