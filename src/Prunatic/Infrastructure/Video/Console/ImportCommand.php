<?php

namespace Prunatic\Infrastructure\Video\Console;

use Prunatic\Domain\Video\Import\ImportService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends Command
{
    /** @var ImportService */
    private $importVideoService;

    public function __construct(ImportService $importVideoService)
    {
        parent::__construct();
        $this->importVideoService = $importVideoService;
    }

    protected function configure()
    {
        $this
            ->setName('video:import')
            ->setDescription('Video importer')
            ->addArgument('site', InputArgument::REQUIRED, 'Site to import the video from')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $site = $input->getArgument('site');
        $output->write(sprintf('Importing site "%s".', $site));

        $this->importVideoService->execute($site);

        $output->write(sprintf('Import finished.'));
    }
}
