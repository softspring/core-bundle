<?php

namespace Softspring\CoreBundle\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigTest;

class InstanceOfExtension extends AbstractExtension
{
    public function getTests()
    {
        return [new TwigTest('instanceof', [$this, 'instanceOf'])];
    }

    /**
     * @param mixed  $var
     * @param string $class
     *
     * @return bool
     */
    public function instanceOf($var, string $class): bool
    {
        return $var instanceof $class;
    }
}