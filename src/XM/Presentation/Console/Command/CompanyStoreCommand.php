<?php

declare(strict_types=1);

namespace App\XM\Presentation\Console\Command;

use App\XM\Domain\CompanyService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CompanyStoreCommand extends Command
{
    private CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:company-store')
            ->setHelp('This command will store company data to DB')
            ->setDescription('This command will store company data to DB')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->companyService->storeCompaniesToDb();

        $io->success('Companies succesfully stored to DB');

        return Command::SUCCESS;
    }
}