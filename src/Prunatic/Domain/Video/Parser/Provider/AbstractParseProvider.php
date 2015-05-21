<?php

namespace Prunatic\Domain\Video\Parser\Provider;

use Prunatic\Domain\Video\Builder\VideoBuilder;

abstract class AbstractParseProvider implements ParserProvider
{
    /**
     * @inheritdoc
     */
    public function parseVideoContent($contents)
    {
        $result = [];
        $elements = $this->contentsToArray($contents);
        foreach ($elements as $element) {
            $builder = VideoBuilder::aVideo();
            if (!empty($element['title'])) {
                $builder->withTitle($element['title']);
            }
            if (!empty($element['url'])) {
                $builder->withUrl($element['url']);
            }
            if (!empty($element['tags'])) {
                $builder->withTags(array_values((array) $element['tags']));
            }
            $result[] = $builder->build();
        }

        return $result;
    }

    /**
     * @param array $contents
     * @return \Generator
     */
    abstract protected function contentsToArray($contents);
}
