<?php

namespace Softspring\CoreBundle\Tests\Controller\Traits;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;

class DoctrineShotcutsTraitTest extends TestCase
{
    public function testPersist()
    {
        $registry = $this->createMock(ManagerRegistry::class);
        $em = $this->createMock(EntityManagerInterface::class);
        $registry->expects($this->any())->method('getManager')->willReturn($em);

        $em->expects($this->once())->method('persist');
        $em->expects($this->never())->method('flush');

        $trait = new DoctrineShotcutsTraitClass($registry);
        $trait->doPersist(new \stdClass(), false);
    }

    public function testRemove()
    {
        $registry = $this->createMock(ManagerRegistry::class);
        $em = $this->createMock(EntityManagerInterface::class);
        $registry->expects($this->any())->method('getManager')->willReturn($em);

        $em->expects($this->once())->method('remove');
        $em->expects($this->never())->method('flush');

        $trait = new DoctrineShotcutsTraitClass($registry);
        $trait->doRemove(new \stdClass(), false);
    }

    public function testPersistWithFlush()
    {
        $registry = $this->createMock(ManagerRegistry::class);
        $em = $this->createMock(EntityManagerInterface::class);
        $registry->expects($this->any())->method('getManager')->willReturn($em);

        $em->expects($this->once())->method('persist');
        $em->expects($this->once())->method('flush');

        $trait = new DoctrineShotcutsTraitClass($registry);
        $trait->doPersist(new \stdClass(), true);
    }

    public function testRemoveWithFlush()
    {
        $registry = $this->createMock(ManagerRegistry::class);
        $em = $this->createMock(EntityManagerInterface::class);
        $registry->expects($this->any())->method('getManager')->willReturn($em);

        $em->expects($this->once())->method('remove');
        $em->expects($this->once())->method('flush');

        $trait = new DoctrineShotcutsTraitClass($registry);
        $trait->doRemove(new \stdClass(), true);
    }

    public function testGetRepository()
    {
        $registry = $this->createMock(ManagerRegistry::class);
        $em = $this->createMock(EntityManagerInterface::class);
        $registry->expects($this->any())->method('getManager')->willReturn($em);

        $repo = $this->createMock(ObjectRepository::class);
        $em->expects($this->once())->method('getRepository')->willReturn($repo);

        $trait = new DoctrineShotcutsTraitClass($registry);

        $this->assertEquals($repo, $trait->doGetRepository(\stdClass::class));
    }
}
