<?php

namespace Tests\Prunatic\Domain\Video\Parser;

use Prunatic\Domain\Video\Parser\ContentParserFactory;
use Prunatic\Domain\Video\Parser\Provider\FlubParseProvider;
use Prunatic\Domain\Video\Parser\Provider\GlorfParseProvider;

class ContentParserFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ContentParserFactory */
    private $sut;

    protected function setUp()
    {
        $this->sut = new ContentParserFactory();
    }

    /**
     * @test
     * @dataProvider getCreateValidInstances
     */
    public function shouldCreateValidInstances($site, $expectedParserType)
    {
        $actual = $this->sut->create($site);

        $this->assertInstanceOf($expectedParserType, $actual);
    }

    public function getCreateValidInstances()
    {
        return [
            ['flub', FlubParseProvider::class],
            ['glorf', GlorfParseProvider::class],
        ];
    }

    /**
     * @test
     * @expectedException \Prunatic\Domain\Video\Parser\InvalidParseException
     */
    public function shouldRaiseExceptionWhenUnknownSite()
    {
        $this->sut->create('anUnknownSite');
    }
}
