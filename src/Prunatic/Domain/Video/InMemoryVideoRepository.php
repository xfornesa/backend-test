<?php

namespace Prunatic\Domain\Video;

class InMemoryVideoRepository implements VideoRepository
{
    /** @var Video[] */
    private $elements;

    public function __construct()
    {
        $this->elements = [];
    }

    /**
     * @inheritdoc
     */
    public function add(Video $video)
    {
        $this->elements[] = $video;
    }

    public function getAllVideos()
    {
        return $this->elements;
    }
}
