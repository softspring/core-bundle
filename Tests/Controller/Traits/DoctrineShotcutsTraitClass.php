<?php

namespace Softspring\CoreBundle\Tests\Controller\Traits;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Softspring\CoreBundle\Controller\Traits\DoctrineShortcutsTrait;

class DoctrineShotcutsTraitClass
{
    use DoctrineShortcutsTrait;

    /**
     * @var ManagerRegistry
     */
    protected $registry;

    /**
     * DoctrineShotcutsTraitClass constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return ManagerRegistry
     */
    protected function getDoctrine()
    {
        return $this->registry;
    }

    public function doPersist($entity, bool $flush)
    {
        $this->persist($entity, null, $flush);
    }

    public function doRemove($entity, bool $flush)
    {
        $this->remove($entity, null, $flush);
    }

    public function doGetRepository(string $className)
    {
        return $this->getRepository($className);
    }
}