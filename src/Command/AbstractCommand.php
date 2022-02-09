<?php

namespace Softspring\CoreBundle\Command;

use Softspring\CoreBundle\Controller\Traits\DoctrineShortcutsTrait;
use Softspring\CoreBundle\Controller\Traits\GetDoctrineTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @deprecated will be removed
 */
abstract class AbstractCommand extends Command implements ContainerAwareInterface
{
    use GetDoctrineTrait;
    use DoctrineShortcutsTrait;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
