<?php

namespace Tests\Prunatic\Domain\Video\Loader;

use Prunatic\Domain\Video\Loader\YamlFileLoader;

class YamlFileLoaderTest extends \PHPUnit_Framework_TestCase
{
    /** @var  YamlFileLoader */
    private $sut;
    /** @var  string */
    private $validResource;
    /** @var  string */
    private $invalidResource;

    protected function setUp()
    {
        $this->validResource = __DIR__.'/fixtures/flub.yaml';
        $this->invalidResource = __DIR__.'/fixtures/glorf.json';
        $this->sut = new YamlFileLoader();
    }

    /**
     * @test
     */
    public function shouldSupportYamlExtension()
    {
        $actual = $this->sut->supports($this->validResource);

        $this->assertTrue($actual);
    }

    /**
     * @test
     */
    public function shouldNotSupportOtherExtensions()
    {
        $actual = $this->sut->supports($this->invalidResource);

        $this->assertFalse($actual);
    }

    /**
     * @test
     */
    public function shouldLoadYamlContent()
    {
        $actual = $this->sut->load($this->validResource);

        $expected = [
            'title' => 'aTitle',
            'url' => 'aUrl',
        ];
        $this->assertEquals($expected, $actual);
    }
}
