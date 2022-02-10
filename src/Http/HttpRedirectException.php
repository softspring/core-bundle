<?php

namespace Softspring\CoreBundle\Http;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HttpRedirectException extends HttpException
{
    protected RedirectResponse $response;

    /**
     * HttpRedirectException constructor.
     */
    public function __construct(RedirectResponse $response)
    {
        parent::__construct($response->getStatusCode());
        $this->response = $response;
    }

    public function getResponse(): RedirectResponse
    {
        return $this->response;
    }
}
