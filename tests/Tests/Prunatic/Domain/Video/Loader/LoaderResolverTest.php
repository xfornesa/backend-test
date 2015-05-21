<?php

namespace Tests\Prunatic\Domain\Video\Loader;

use Prunatic\Domain\Video\Loader\FileLoader;
use Prunatic\Domain\Video\Loader\LoaderResolver;

class LoaderResolverTest extends \PHPUnit_Framework_TestCase
{
    /** @var  LoaderResolver */
    private $sut;
    /** @var  FileLoader */
    private $aLoader;

    protected function setUp()
    {
        $this->aLoader = $this->prophesize(FileLoader::class);

        $this->sut = new LoaderResolver([$this->aLoader->reveal()]);
    }

    /**
     * @test
     */
    public function shouldFindLoaderWhenResourceIsSupportedByLoaders()
    {
        $supportedResource = 'supportedResource';
        $this->aLoader->supports($supportedResource)->willReturn(true);

        $actual = $this->sut->resolve($supportedResource);

        $this->assertInstanceOf(FileLoader::class, $actual);
    }

    /**
     * @test
     */
    public function shouldResolveToNullWhenResourceIsUnsupportedByLoaders()
    {
        $unsupportedResource = 'unsupportedResource';
        $this->aLoader->supports($unsupportedResource)->willReturn(false);

        $actual = $this->sut->resolve($unsupportedResource);

        $this->assertNull($actual);
    }
}
