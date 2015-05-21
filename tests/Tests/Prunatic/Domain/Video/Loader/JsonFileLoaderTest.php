<?php

namespace Tests\Prunatic\Domain\Video\Loader;

use Prunatic\Domain\Video\Loader\JsonFileLoader;

class JsonFileLoaderTest extends \PHPUnit_Framework_TestCase
{
    /** @var  JsonFileLoader */
    private $sut;
    /** @var  string */
    private $validResource;
    /** @var  string */
    private $invalidResource;

    protected function setUp()
    {
        $this->validResource = __DIR__.'/fixtures/glorf.json';
        $this->invalidResource = __DIR__.'/fixtures/flub.yaml';
        $this->sut = new JsonFileLoader();
    }

    /**
     * @test
     */
    public function shouldSupportJsonExtension()
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
    public function shouldLoadJsonContent()
    {
        $actual = $this->sut->load($this->validResource);

        $expected = [
            'title' => 'aTitle',
            'url' => 'aUrl',
        ];
        $this->assertEquals($expected, $actual);
    }
}
