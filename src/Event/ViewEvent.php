<?php

namespace Softspring\CoreBundle\Event;

use Symfony\Contracts\EventDispatcher\Event;

class ViewEvent extends Event
{
    /**
     * @var \ArrayObject
     */
    protected $data;

    /**
     * ViewEvent constructor.
     */
    public function __construct(\ArrayObject $data)
    {
        $this->data = $data;
    }

    public function getData(): \ArrayObject
    {
        return $this->data;
    }
}
