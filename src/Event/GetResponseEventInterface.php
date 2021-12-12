<?php

namespace Softspring\CoreBundle\Event;

use Symfony\Component\HttpFoundation\Response;

interface GetResponseEventInterface
{
    /**
     * @return Response|null
     */
    public function getResponse(): ?Response;

    /**
     * @param Response|null $response
     */
    public function setResponse(?Response $response): void;
}