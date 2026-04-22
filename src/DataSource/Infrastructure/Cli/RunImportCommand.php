<?php

declare(strict_types=1);

namespace App\DataSource\Infrastructure\Cli;

use App\DataSource\Application\Service\ImportService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'container:run:import')]
class RunImportCommand extends Command
{
    public function __construct(
        private readonly ImportService $importService,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->importService->run();
        } catch (\Throwable) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
