<?php

namespace Prunatic\Domain\Video\Loader;

use Symfony\Component\Yaml\Yaml;

class YamlFileLoader implements FileLoader
{
    const EXTENSION = 'yaml';

    /**
     * @inheritdoc
     */
    public function load($resource)
    {
        $contents = Yaml::parse(file_get_contents($resource));

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
