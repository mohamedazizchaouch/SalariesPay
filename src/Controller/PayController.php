<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;

class PayController extends AbstractController
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
    
    public function exportAction(Request $request): JsonResponse
    {
        try {
                $input = new ArrayInput([
                    'command' => 'app:SalariesPaySalesDepartment', // Remplacez par le nom de votre commande Symfony
                    // Ajoutez d'autres arguments et options si nécessaire
                ]);
                $output = new BufferedOutput();

                $application = new Application($this->kernel);
                $application->setAutoExit(false);
                $application->run($input, $output);

                $result = $output->fetch();

                return $this->json($result);
            } catch (Exception $e) {
             throw new Exception();
            } 
    }
}
