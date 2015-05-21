<?php

namespace Tests\Prunatic\Domain\Video;

use Prunatic\Domain\Video\Video;

class VideoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldBeInstantiable()
    {
        $actual = new Video('aTitle', 'aUrl', ['aTag']);

        $this->assertInstanceOf(Video::class, $actual);
    }

    /**
     * @test
     */
    public function testGetters()
    {
        $aTitle = 'aTitle';
        $aUrl = 'aUrl';
        $someTags = ['aTag'];

        $actual = new Video($aTitle, $aUrl, $someTags);

        $this->assertEquals($aTitle, $actual->title());
        $this->assertEquals($aUrl, $actual->url());
        $this->assertEquals($someTags, $actual->tags());
    }
}
