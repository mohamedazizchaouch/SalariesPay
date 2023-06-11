<?php

namespace App\Command;

use App\Manager\SalariesPayManager;
use App\Service\CsvService;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

#[AsCommand(
    name: 'app:SalariesPaySalesDepartment',
    description: 'Add a short description for your command',
)]
class SalariesPaySalesDepartmentCommand extends Command
{
    private $salariesPayManager ;
    private $csvService;
    public function __construct(SalariesPayManager $salariesPayManager,
                                CsvService $csvService)
    {
        parent::__construct();
        $this->salariesPayManager = $salariesPayManager;
        $this->csvService = $csvService;
    }
    protected function configure()
    {
        $this
            ->setName('mon-commande')
            ->setDescription('Description de ma commande')
            ->addOption('Year', 'y', InputOption::VALUE_OPTIONAL, 'Number of salary dates to generate');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {   
        $year = (int) $input->getOption('Year');
        $payDate = $this->salariesPayManager->getDateOfPay($year);
        try {
            $csvfile = $this->csvService->generateCsv($payDate);
            $response = new BinaryFileResponse($csvfile);
            $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'SalariesBonnusPayDate.csv'
            );
            $response->deleteFileAfterSend(true);
            $response->send();
            return Command::SUCCESS;

        } catch (Exception $e) {
            $output->writeln('An error occurred: ' . $e->getMessage());
            return Command::FAILURE;
        } 
    }
}
