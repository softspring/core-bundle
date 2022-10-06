<?php

namespace Softspring\CoreBundle\Event;

use Softspring\Component\Events\GetResponseEvent as NewGetResponseEvent;

/**
 * @deprecated use softspring/events component
 */
class GetResponseEvent extends NewGetResponseEvent implements GetResponseEventInterface
{
}
