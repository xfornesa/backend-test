<?php

namespace Tests\Prunatic\Domain\Video\Import;

use Prophecy\Argument;
use Prunatic\Domain\Video\Builder\VideoBuilder;
use Prunatic\Domain\Video\Import\ImportService;
use Prunatic\Domain\Video\Loader\FileLoader;
use Prunatic\Domain\Video\Parser\ContentParserFactory;
use Prunatic\Domain\Video\Parser\Provider\ParserProvider;
use Prunatic\Domain\Video\Video;
use Prunatic\Domain\Video\VideoRepository;

class ImportServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ImportService */
    private $sut;
    /** @var  VideoRepository */
    private $videoRepository;
    /** @var  FileLoader */
    private $fileLoader;
    /** @var  ContentParserFactory */
    private $parserFactory;
    /** @var  Video */
    private $aVideo;
    /** @var  string */
    private $site;

    protected function setUp()
    {
        $this->site = 'flub';

        $feedsPath = __DIR__.'/fixtures';
        $fileContents = [];
        $this->videoRepository = $this->prophesize(VideoRepository::class);
        $this->fileLoader = $this->prophesize(FileLoader::class);
        $this->fileLoader->load(Argument::containingString($this->site))->willReturn($fileContents);
        $this->parserFactory = $this->prophesize(ContentParserFactory::class);
        $parser = $this->prophesize(ParserProvider::class);
        $this->aVideo = VideoBuilder::aVideo()->build();
        $parser->parseVideoContent($fileContents)->willReturn([$this->aVideo]);

        $this->parserFactory->create($this->site)->willReturn($parser->reveal());

        $this->sut = new ImportService(
            $this->videoRepository->reveal(),
            $feedsPath,
            $this->fileLoader->reveal(),
            $this->parserFactory->reveal()
        );
    }

    /**
     * @test
     */
    public function shouldUseLoaderToGetFileContents()
    {
        $this->fileLoader->load(Argument::containingString($this->site))->shouldBeCalled();

        $this->sut->execute($this->site);
    }

    /**
     * @test
     */
    public function shouldUseParserFactoryToGetParser()
    {
        $this->parserFactory->create($this->site)->shouldBeCalled();

        $this->sut->execute($this->site);
    }

    /**
     * @test
     */
    public function shouldPersistVideosFound()
    {
        $this->videoRepository->add($this->aVideo)->shouldBeCalled();

        $this->sut->execute($this->site);
    }
}
