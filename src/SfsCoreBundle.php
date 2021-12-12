<?php

namespace Softspring\CoreBundle;

use Softspring\CoreBundle\DependencyInjection\Compiler\ExtensibleAppVariablePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SfsCoreBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ExtensibleAppVariablePass());
    }
}