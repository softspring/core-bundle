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
     * @param mixed $var
     */
    public function instanceOf($var, string $class): bool
    {
        return $var instanceof $class;
    }
}
