<?php

namespace Prunatic\Domain\Video\Builder;

use Prunatic\Domain\Video\Video;

class VideoBuilder
{
    /** @var  string */
    private $title;
    /** @var  string */
    private $url;
    /** @var  string[] */
    private $tags;

    private function __construct()
    {
    }

    /**
     * @return VideoBuilder
     */
    public static function aVideo()
    {
        $self = new self();
        $self->title = '';
        $self->url = '';
        $self->tags = [];

        return $self;
    }

    /**
     * @return Video
     */
    public function build()
    {
        return new Video($this->title, $this->url, $this->tags);
    }

    /**
     * @param string $title
     * @return VideoBuilder
     */
    public function withTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $url
     * @return VideoBuilder
     */
    public function withUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string[] $tags
     * @return VideoBuilder
     */
    public function withTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }
}
