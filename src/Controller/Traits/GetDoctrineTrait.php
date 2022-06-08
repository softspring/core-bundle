<?php

namespace Softspring\CoreBundle\Controller\Traits;

use Symfony\Bridge\Doctrine\ManagerRegistry;

/**
 * @deprecated use dependency injection
 */
trait GetDoctrineTrait
{
    /**
     * Shortcut to return the Doctrine Registry service.
     *
     * @throws \LogicException If DoctrineBundle is not available
     *
     * @final
     */
    protected function getDoctrine(): ManagerRegistry
    {
        if (!$this->container->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application. Try running "composer require symfony/orm-pack".');
        }

        return $this->container->get('doctrine');
    }
}
