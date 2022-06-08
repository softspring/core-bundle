<?php

namespace Softspring\CoreBundle\Event;

/**
 * @deprecated use softspring/events component
 */
class GetResponseRequestEvent extends RequestEvent implements GetResponseEventInterface
{
    use GetResponseTrait;
}
