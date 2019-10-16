<?php

namespace Softspring\CoreBundle\Twig;

use Symfony\Bridge\Twig\AppVariable as BaseAppVariable;

class ExtensibleAppVariable extends BaseAppVariable
{
    protected $extraData = [];

    public function __call($method, $params)
    {
        if (method_exists($this, $method)) {
            return call_user_func_array([$this, $method], $params);
        }

        $key = lcfirst(substr($method, 3));

        if (strncasecmp($method, "get", 3) === 0) {
            return $this->extraData[$key];
        }
        if (strncasecmp($method, "set", 3) === 0) {
            $this->extraData[$key] = $params[0];
        }
    }
}