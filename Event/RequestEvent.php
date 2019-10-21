<?php

namespace Softspring\CoreBundle\Event;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class RequestEvent
 */
class RequestEvent extends Event
{
    /**
     * @var Request|null
     */
    protected $request;

    /**
     * RequestEvent constructor.
     *
     * @param Request|null $request
     */
    public function __construct(?Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Request|null
     */
    public function getRequest(): ?Request
    {
        return $this->request;
    }
}