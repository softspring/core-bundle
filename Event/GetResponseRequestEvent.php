<?php

namespace Softspring\CoreBundle\Event;

class GetResponseRequestEvent extends RequestEvent implements GetResponseEventInterface
{
    use GetResponseTrait;
}