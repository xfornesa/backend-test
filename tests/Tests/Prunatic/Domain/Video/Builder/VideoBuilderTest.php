<?php

namespace Tests\Prunatic\Domain\Video\Builder;

use Prunatic\Domain\Video\Builder\VideoBuilder;
use Prunatic\Domain\Video\Video;

class VideoBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var  string */
    private $defaultTitle;
    /** @var  string */
    private $defaultUrl;
    /** @var  string[] */
    private $defaultTags;

    protected function setUp()
    {
        $this->defaultTitle = '';
        $this->defaultUrl = '';
        $this->defaultTags = [];
    }


    /**
     * @test
     */
    public function shouldBuildVideoInstances()
    {
        $actual = VideoBuilder::aVideo()->build();

        $this->assertInstanceOf(Video::class, $actual);
    }

    /**
     * @test
     */
    public function shouldProvideDefaultValueForTitle()
    {
        $actual = VideoBuilder::aVideo()->build();

        $this->assertEquals($this->defaultTitle, $actual->title());
    }

    /**
     * @test
     */
    public function shouldLetSetValueForTitle()
    {
        $aTitle = 'aTitle';

        $actual = VideoBuilder::aVideo()->withTitle($aTitle)->build();

        $this->assertEquals($aTitle, $actual->title());
    }

    /**
     * @test
     */
    public function shouldProvideDefaultValueForUrl()
    {
        $actual = VideoBuilder::aVideo()->build();

        $this->assertEquals($this->defaultUrl, $actual->url());
    }

    /**
     * @test
     */
    public function shouldLetSetValueForUrl()
    {
        $aUrl = 'aUrl';

        $actual = VideoBuilder::aVideo()->withUrl($aUrl)->build();

        $this->assertEquals($aUrl, $actual->url());
    }

    /**
     * @test
     */
    public function shouldProvideDefaultValueForTags()
    {
        $actual = VideoBuilder::aVideo()->build();

        $this->assertEquals($this->defaultTags, $actual->tags());
    }

    /**
     * @test
     */
    public function shouldLetSetValueForTags()
    {
        $someTags = ['tag1', 'tag2'];

        $actual = VideoBuilder::aVideo()->withTags($someTags)->build();

        $this->assertEquals($someTags, $actual->tags());
    }
}
