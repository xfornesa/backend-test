<?php

namespace Prunatic\Domain\Video\Parser\Provider;

use Prunatic\Domain\Video\Video;

interface ParserProvider
{
    /**
     * @param array $contents
     * @return Video[]
     */
    public function parseVideoContent($contents);
}
