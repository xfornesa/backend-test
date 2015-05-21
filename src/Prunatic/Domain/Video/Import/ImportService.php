<?php

namespace Prunatic\Domain\Video\Import;

use Prunatic\Domain\Video\Loader\FileLoader;
use Prunatic\Domain\Video\Parser\ContentParserFactory;
use Prunatic\Domain\Video\Video;
use Prunatic\Domain\Video\VideoRepository;
use Symfony\Component\Finder\Finder;

class ImportService
{
    /** @var VideoRepository */
    private $videoRepository;
    /** @var string string */
    private $feedsPath;
    /** @var FileLoader */
    private $loader;
    /** @var ContentParserFactory */
    private $parserFactory;

    /**
     * @param VideoRepository $videoRepository
     * @param string $feedsPath
     * @param FileLoader $loader
     * @param ContentParserFactory $parserFactory
     */
    public function __construct(
        VideoRepository $videoRepository,
        $feedsPath,
        FileLoader $loader,
        ContentParserFactory $parserFactory
    ) {
        $this->videoRepository = $videoRepository;
        $this->feedsPath = $feedsPath;
        $this->loader = $loader;
        $this->parserFactory = $parserFactory;
    }

    /**
     * @param string $site
     */
    public function execute($site)
    {
        $videos = $this->parseSiteContents($site);
        foreach ($videos as $video) {
            $this->persistVideo($video);
            $this->raiseVideoImportedEvent($video);
        }
    }

    private function parseSiteContents($site)
    {
        $contents = $this->getContents($site);
        $parser = $this->parserFactory->create($site);
        $videos = $parser->parseVideoContent($contents);

        return $videos;
    }

    private function getContents($site)
    {
        $file = $this->getFilePath($site);
        $contents = $this->loader->load($file);

        return $contents;
    }

    private function getFilePath($site)
    {
        $file = $this->getFile($site);
        if ($file) {
            return $file->getRealPath();
        }
        throw new \Exception(sprintf('No file found for "%s"', $site));

    }

    /**
     * @param string $site
     * @return \SplFileInfo
     */
    private function getFile($site)
    {
        $finder = new Finder();
        $files = $finder->files()->name($site.'.*')->in(realpath($this->feedsPath));
        foreach ($files as $file) {
            return $file;
        }
        return null;
    }

    private function persistVideo(Video $video)
    {
        $this->videoRepository->add($video);
    }

    private function raiseVideoImportedEvent(Video $video)
    {
        $logMessage = "importing: \"%s\"; Url: %s; Tags: %s\n";
        echo sprintf($logMessage, $video->title(), $video->url(), implode(',', $video->tags()));
    }
}
