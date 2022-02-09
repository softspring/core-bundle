<?php

namespace Softspring\CoreBundle\Event;

use Symfony\Component\HttpFoundation\Response;

interface GetResponseEventInterface
{
    public function getResponse(): ?Response;

    public function setResponse(?Response $response): void;
}
