<?php

namespace Prunatic\Domain\Video\Parser\Provider;

class FlubParseProvider extends AbstractParseProvider implements ParserProvider
{
    /**
     * @inheritdoc
     */
    protected function contentsToArray($contents)
    {
        $elements = (array) $contents;
        foreach ($elements as $element) {
            $video = [];
            if (isset($element['title'])) {
                $video['title'] = $element['title'];
            }
            if (isset($element['url'])) {
                $video['url'] = $element['url'];
            }
            if (isset($element['tags'])) {
                $video['tags'] = (array) $element['tags'];
            }
            yield $video;
        }
    }
}
