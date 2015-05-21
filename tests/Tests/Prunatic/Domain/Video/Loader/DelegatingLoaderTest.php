<?php

namespace Tests\Prunatic\Domain\Video\Loader;

use Prunatic\Domain\Video\Loader\DelegatingLoader;
use Prunatic\Domain\Video\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\FileLoader;

class DelegatingLoaderTest extends \PHPUnit_Framework_TestCase
{
    /** @var  DelegatingLoader */
    private $sut;
    /** @var  LoaderResolver */
    private $resolver;

    protected function setUp()
    {
        $this->resolver = $this->prophesize(LoaderResolver::class);

        $this->sut = new DelegatingLoader($this->resolver->reveal());
    }

    /**
     * @test
     */
    public function shouldDelegateSupportsToResolver()
    {
        $aResource = 'aResource';
        $aLoader = $this->prophesize(FileLoader::class)->reveal();
        $this->resolver->resolve($aResource)->willReturn($aLoader);
        $this->resolver->resolve($aResource)->shouldBeCalled();

        $this->sut->supports($aResource);
    }

    /**
     * @test
     */
    public function shouldDelegateLoadToResolver()
    {
        $aResource = 'aResource';
        $aLoader = $this->prophesize(FileLoader::class)->reveal();
        $this->resolver->resolve($aResource)->willReturn($aLoader);
        $this->resolver->resolve($aResource)->shouldBeCalled();

        $this->sut->load($aResource);
    }

    /**
     * @test
     * @expectedException \Prunatic\Domain\Video\Loader\MissingFileLoaderException
     */
    public function shouldRaiseExceptionWhenUnsupportedResource()
    {
        $unsupportedResource = 'unsupportedResource';
        $this->resolver->resolve($unsupportedResource)->willReturn(null);

        $this->sut->load($unsupportedResource);
    }
}
