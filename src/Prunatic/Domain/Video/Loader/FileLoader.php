<?php

namespace Prunatic\Domain\Video\Loader;

interface FileLoader
{
    /**
     * @param string $resource
     * @return array
     */
    public function load($resource);

    /**
     * @param string $resource
     * @return bool
     */
    public function supports($resource);
}
