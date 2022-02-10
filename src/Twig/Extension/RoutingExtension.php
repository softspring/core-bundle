<?php

namespace Softspring\CoreBundle\Twig\Extension;

use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RoutingExtension extends AbstractExtension
{
    protected UrlGeneratorInterface $urlGenerator;

    /**
     * RoutingExtension constructor.
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('route_defined', [$this, 'isRouteDefined']),
        ];
    }

    public function isRouteDefined(string $routeName): bool
    {
        try {
            $this->urlGenerator->generate($routeName);

            return true;
        } catch (MissingMandatoryParametersException $e) {
            return true;
        } catch (InvalidParameterException $e) {
            return true;
        } catch (RouteNotFoundException $e) {
            return false;
        }
    }
}
