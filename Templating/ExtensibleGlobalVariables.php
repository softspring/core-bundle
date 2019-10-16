<?php

namespace Softspring\CoreBundle\Templating;

use Symfony\Bundle\FrameworkBundle\Templating\GlobalVariables as BaseGlobalVariables;

/**
 * Class ExtensibleGlobalVariables
 * @deprecated will be removed on Symfony 5.0
 */
class ExtensibleGlobalVariables extends BaseGlobalVariables
{
    protected $extraData = [];

    public function __get( $key )
    {
        return $this->extraData[ $key ];
    }

    public function __set( $key, $value )
    {
        $this->extraData[$key] = $value;
    }
}