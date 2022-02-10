<?php

namespace Softspring\CoreBundle\Event;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class RequestEvent.
 */
class RequestEvent extends Event
{
    protected ?Request $request;

    /**
     * RequestEvent constructor.
     */
    public function __construct(?Request $request)
    {
        $this->request = $request;
    }

    public function getRequest(): ?Request
    {
        return $this->request;
    }
}
