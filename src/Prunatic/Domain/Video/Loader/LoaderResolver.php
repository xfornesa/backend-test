<?php

namespace Prunatic\Domain\Video\Loader;

class LoaderResolver
{
    /** @var FileLoader[] */
    private $loaders;

    /**
     * @param FileLoader[] $loaders
     * @throws MissingFileLoaderException
     */
    public function __construct($loaders)
    {
        $this->loaders = [];
        foreach ($loaders as $loader) {
            $this->addLoader($loader);
        }
    }

    private function addLoader(FileLoader $loader)
    {
        $this->loaders[] = $loader;
    }

    /**
     * @param string $resource
     * @return null|FileLoader
     */
    public function resolve($resource)
    {
        foreach ($this->loaders as $loader) {
            if ($loader->supports($resource)) {
                return $loader;
            }
        }

        return null;
    }
}
