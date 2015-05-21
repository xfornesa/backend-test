<?php

namespace Tests\Prunatic\Domain\Video;

use Prunatic\Domain\Video\Builder\VideoBuilder;
use Prunatic\Domain\Video\InMemoryVideoRepository;

class InMemoryVideoRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var  InMemoryVideoRepository */
    private $sut;

    protected function setUp()
    {
        $this->sut = new InMemoryVideoRepository();
    }

    /**
     * @test
     */
    public function shouldHaveNoVideosWhenNew()
    {
        $this->assertEmpty($this->sut->getAllVideos());
    }

    /**
     * @test
     */
    public function shouldLetAddVideos()
    {
        $aVideo = VideoBuilder::aVideo()->build();

        $this->sut->add($aVideo);

        $videos = $this->sut->getAllVideos();
        $this->assertSame($aVideo, $videos[0]);
    }
}
