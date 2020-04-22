<?php

namespace Softspring\CoreBundle\Twig\Extension;

use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EncoreEntrySourcesExtension extends AbstractExtension
{
    /**
     * @var EntrypointLookupInterface
     */
    protected $entrypointLookup;

    /**
     * @var string
     */
    protected $publicPath;

    /**
     * EncoreEntryCssExtension constructor.
     *
     * @param EntrypointLookupInterface $entrypointLookup
     * @param string                    $publicPath
     */
    public function __construct(EntrypointLookupInterface $entrypointLookup, string $publicPath)
    {
        $this->entrypointLookup = $entrypointLookup;
        $this->publicPath = $publicPath;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('encore_entry_css_source', [$this, 'getCssSource']),
            new TwigFunction('encore_entry_js_source', [$this, 'getJsSource']),
        ];
    }

    public function getCssSource(string $entryName): string
    {
        return array_reduce($this->entrypointLookup->getCssFiles($entryName), function ($accumulatedSource, $file) {
            return $accumulatedSource . file_get_contents("{$this->publicPath}$file");
        }, '');
    }

    public function getJsSource(string $entryName): string
    {
        return array_reduce($this->entrypointLookup->getJavaScriptFiles($entryName), function ($accumulatedSource, $file) {
            return $accumulatedSource . file_get_contents("{$this->publicPath}$file");
        }, '');
    }
}