<?php

namespace Softspring\CoreBundle\Event;

class GetResponseFormEvent extends FormEvent implements GetResponseEventInterface
{
    use GetResponseTrait;
}