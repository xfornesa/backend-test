<?php

namespace Tests\Prunatic\Domain\Video\Parser\Provider;

use Prunatic\Domain\Video\Parser\Provider\FlubParseProvider;

class FlubParserProviderTest extends \PHPUnit_Framework_TestCase
{
    /** @var  FlubParseProvider */
    private $sut;

    protected function setUp()
    {
        $this->sut = new FlubParseProvider();
    }

    /**
     * @test
     */
    public function shouldParseContentsProvidingVideos()
    {
        $aTitle = 'aTitle';
        $aUrl = 'aUrl';
        $someTags = ['aTag'];
        $contents = [
            [
                'title' => $aTitle,
                'url' => $aUrl,
                'tags' => $someTags,
            ]
        ];

        $actual = $this->sut->parseVideoContent($contents);

        $video = reset($actual);
        $this->assertEquals($aTitle, $video->title());
        $this->assertEquals($aUrl, $video->url());
        $this->assertEquals($someTags, $video->tags());
    }
}
