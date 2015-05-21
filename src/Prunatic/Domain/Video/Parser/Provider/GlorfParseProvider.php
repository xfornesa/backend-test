<?php

namespace Prunatic\Domain\Video\Parser\Provider;

class GlorfParseProvider extends AbstractParseProvider implements ParserProvider
{
    /**
     * @inheritdoc
     */
    protected function contentsToArray($contents)
    {
        $elements = isset($contents['videos']) ? (array)$contents['videos'] : [];
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
