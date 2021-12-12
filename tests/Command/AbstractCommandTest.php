<?php

namespace Softspring\CoreBundle\Tests\Command;

use PHPUnit\Framework\TestCase;

class AbstractCommandTest extends TestCase
{
    public function testSetContainer()
    {
        // get protected property
        $class = new \ReflectionClass(TestCommand::class);
        $property = $class->getProperty('container');
        $property->setAccessible(true);;

        // prepare test
        $command = new TestCommand();
        $container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerInterface')
            ->getMock();
        $command->setContainer($container);

        // test
        $this->assertEquals($container, $property->getValue($command));
    }

    public function testGetDoctrineWithoutIt()
    {
        // get protected method
        $class = new \ReflectionClass(TestCommand::class);
        $method = $class->getMethod('getDoctrine');
        $method->setAccessible(true);

        // prepare test
        $command = new TestCommand();
        $container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerInterface')
            ->getMock();
        $command->setContainer($container);

        // test
        $this->expectException(\LogicException::class);
        $method->invoke($command);
    }

    public function testGetDoctrine()
    {
        // get protected method
        $class = new \ReflectionClass(TestCommand::class);
        $method = $class->getMethod('getDoctrine');
        $method->setAccessible(true);

        // prepare test
        $command = new TestCommand();
        $doctrine = $this->getMockBuilder('Symfony\Bridge\Doctrine\ManagerRegistry')->disableOriginalConstructor()->getMock();
        $container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerInterface')->getMock();
        $container->expects($this->once())->method('has')->with($this->equalTo('doctrine'))->will($this->returnValue(true));
        $container->expects($this->once())->method('get')->with($this->equalTo('doctrine'))->will($this->returnValue($doctrine));
        $command->setContainer($container);

        // test
        $this->assertEquals($doctrine, $method->invoke($command));
    }
}