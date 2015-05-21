<?php

namespace Prunatic\Domain\Video\Loader;

class JsonFileLoader implements FileLoader
{
    const EXTENSION = 'json';

    /**
     * @inheritdoc
     */
    public function load($resource)
    {
        $contents = json_decode(file_get_contents($resource), true);

        return $contents;
    }

    /**
     * @inheritdoc
     */
    public function supports($resource)
    {
        return is_string($resource) && self::EXTENSION === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
}
