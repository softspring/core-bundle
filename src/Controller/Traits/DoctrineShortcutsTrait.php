<?php

namespace Softspring\CoreBundle\Controller\Traits;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * @deprecated
 */
trait DoctrineShortcutsTrait
{
    /**
     * @param object $entity
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
     * @param object $entity
     */
    protected function remove($entity, ?string $managerName = null, bool $flush = true): void
    {
        $em = $this->getEntityManager($managerName);
        $em->remove($entity);

        if ($flush) {
            $em->flush();
        }
    }

    protected function getEntityManager(?string $managerName = null): EntityManagerInterface
    {
        return $this->getDoctrine()->getManager($managerName);
    }

    protected function getRepository(string $className, ?string $managerName = null): ObjectRepository
    {
        return $this->getEntityManager($managerName)->getRepository($className);
    }
}
