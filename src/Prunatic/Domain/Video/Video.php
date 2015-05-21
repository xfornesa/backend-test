<?php

namespace Prunatic\Domain\Video;

class Video
{
    /** @var string */
    private $title;
    /** @var string */
    private $url;
    /** @var string[] */
    private $tags;

    /**
     * @param string $title
     * @param string $url
     * @param string[] $tags
     */
    public function __construct($title, $url, array $tags)
    {
        $this->title = $title;
        $this->url = $url;
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * @return string[]
     */
    public function tags()
    {
        return $this->tags;
    }
}
