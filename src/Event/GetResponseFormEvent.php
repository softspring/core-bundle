<?php

namespace Softspring\CoreBundle\Event;

/**
 * @deprecated use softspring/events component
 */
class GetResponseFormEvent extends FormEvent implements GetResponseEventInterface
{
    use GetResponseTrait;
}
