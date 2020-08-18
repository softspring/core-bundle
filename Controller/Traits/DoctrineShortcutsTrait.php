<?php

namespace Softspring\CoreBundle\Controller\Traits;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

trait DoctrineShortcutsTrait
{
    /**
     * @param object      $entity
     * @param string|null $managerName
     * @param bool        $flush
     */
    protected function persist($entity, ?string $managerName = null, bool $flush = true): void
    {
        $em = $this->getEntityManager($managerName);
        $em->persist($entity);

        if ($flush) {
            $em->flush();
        }
    }

    /**
     * @param object      $entity
     * @param string|null $managerName
     * @param bool        $flush
     */
    protected function remove($entity, ?string $managerName = null, bool $flush = true): void
    {
        $em = $this->getEntityManager($managerName);
        $em->remove($entity);

        if ($flush) {
            $em->flush();
        }
    }

    /**
     * @param string|null $managerName
     * @return EntityManagerInterface
     */
    protected function getEntityManager(?string $managerName = null): EntityManagerInterface
    {
        return $this->getDoctrine()->getManager($managerName);
    }

    /**
     * @param string      $className
     * @param string|null $managerName
     * @return ObjectRepository
     */
    protected function getRepository(string $className, ?string $managerName = null): ObjectRepository
    {
        return $this->getEntityManager($managerName)->getRepository($className);
    }
}