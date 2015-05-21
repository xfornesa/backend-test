<?php

namespace Prunatic\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit_Framework_Assert as Asserts;
use Prunatic\Domain\Video\Import\ImportService;
use Prunatic\Domain\Video\InMemoryVideoRepository;
use Prunatic\Domain\Video\Loader\DelegatingLoader;
use Prunatic\Domain\Video\Loader\JsonFileLoader;
use Prunatic\Domain\Video\Loader\LoaderResolver;
use Prunatic\Domain\Video\Loader\YamlFileLoader;
use Prunatic\Domain\Video\Parser\ContentParserFactory;
use Symfony\Component\Finder\Finder;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /** @var string */
    private $feedsPath;
    /** @var  string */
    private $commandOutput;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct($feedsPath)
    {
        $this->feedsPath = $feedsPath;
    }

    /**
     * @Given it exists the feed for :site
     */
    public function itExistsFeed($site)
    {
        $finder = new Finder();
        $files = $finder->files()->name($site.'.*')->in(realpath($this->feedsPath));
        $exists = false;
        foreach ($files as $file) {
            $exists = strstr($file->getFilename(), $site) !== false;
        }
        Asserts::assertTrue($exists);
    }

    /**
     * @When I import :site site
     */
    public function iImportSite($site)
    {
        $videoRepository = new InMemoryVideoRepository();
        $resolver = new LoaderResolver([new YamlFileLoader(), new JsonFileLoader()]);
        $loader = new DelegatingLoader($resolver);
        $parserFactory = new ContentParserFactory();

        $importService = new ImportService($videoRepository, $this->feedsPath, $loader, $parserFactory);
        ob_start();
        $importService->execute($site);
        $this->commandOutput = ob_get_contents();
    }

    /**
     * @Then I should see an output like:
     */
    public function iShouldSeeAnOutputLike(PyStringNode $string)
    {
        $expected = trim($string->getRaw());
        $actual = trim($this->commandOutput);
        Asserts::assertEquals($expected, $actual);
    }
}
