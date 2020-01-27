<?php

namespace Softspring\CoreBundle\Controller;

use Softspring\CoreBundle\Controller\Traits\DispatchGetResponseTrait;
use Softspring\CoreBundle\Controller\Traits\DispatchTrait;
use Softspring\CoreBundle\Controller\Traits\DoctrineShortcutsTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SfAbstractController;

abstract class AbstractController extends SfAbstractController
{
    use DispatchTrait;
    use DispatchGetResponseTrait;
    use DoctrineShortcutsTrait;

    /**
     * @inheritDoc
     */
    public static function getSubscribedServices()
    {
        return array_merge(parent::getSubscribedServices(), ['event_dispatcher']);
    }
}