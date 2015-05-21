<?php

namespace Prunatic\Domain\Video\Loader;

class DelegatingLoader implements FileLoader
{
    /**
     * @param LoaderResolver $resolver
     */
    public function __construct(LoaderResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * {@inheritdoc}
     */
    public function load($resource)
    {
        $loader = $this->resolver->resolve($resource);
        if (!$loader) {
            throw new MissingFileLoaderException($resource);
        }

        $contents = $loader->load($resource);

        return $contents;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($resource)
    {
        return null !== $this->resolver->resolve($resource);
    }
}
