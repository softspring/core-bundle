<?php

namespace Softspring\CoreBundle\Event;

use Symfony\Component\HttpFoundation\Request;

class ViewEvent extends RequestEvent
{
    protected \ArrayObject $data;

    /**
     * @param \ArrayObject|array $data
     */
    public function __construct($data, ?Request $request = null)
    {
        parent::__construct($request);

        if (!$data instanceof \ArrayObject && !is_array($data)) {
            throw new \InvalidArgumentException('$data must be an ArrayObject or just an array');
        }

        if (is_array($data)) {
            $data = new \ArrayObject($data);
        }

        $this->data = $data;
    }

    public function getData(): \ArrayObject
    {
        return $this->data;
    }
}
