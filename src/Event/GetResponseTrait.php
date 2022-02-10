<?php

namespace Softspring\CoreBundle\Event;

use Symfony\Component\HttpFoundation\Response;

trait GetResponseTrait
{
    protected ?Response $response;

    public function getResponse(): ?Response
    {
        return $this->response;
    }

    public function setResponse(?Response $response): void
    {
        $this->response = $response;
    }
}
