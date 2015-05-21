<?php

namespace Tests\Prunatic\Infrastructure\Video\Console;

use Prunatic\Domain\Video\Import\ImportService;
use Prunatic\Infrastructure\Video\Console\ImportCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ImportCommand */
    private $sut;
    /** @var  ImportService */
    private $importService;

    protected function setUp()
    {
        $this->importService = $this->prophesize(ImportService::class);

        $this->sut = new ImportCommand($this->importService->reveal());
    }

    /**
     * @test
     */
    public function should()
    {
        $input = new ArrayInput(['site' => 'flub']);
        $output = $this->prophesize(OutputInterface::class);
        $this->importService->execute('flub')->shouldBeCalled();

        $this->sut->run($input, $output->reveal());
    }

}
