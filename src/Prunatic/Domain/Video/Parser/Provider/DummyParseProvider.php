<?php

namespace Prunatic\Domain\Video\Parser\Provider;

class DummyParseProvider extends AbstractParseProvider
{
    /**
     * @param array $contents
     * @return \Generator
     */
    protected function contentsToArray($contents)
    {
        return $contents;
    }
}
