<?php

namespace App\Application\Command;

use App\Service\EmailValidateService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EmailValidationCommand extends Command
{
    public function __construct(
        private readonly EmailValidateService $service
    ) {
        parent::__construct('validate:email');
    }

    protected function configure()
    {
        $this->setName('validate:email')
            ->setDescription('Validates email using a variety of approaches.')
            ->setHelp('Demonstration of custom commands created by Symfony Console component.')
            ->addArgument('email', InputArgument::REQUIRED, 'Pass the email.');
    }

    /**
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {         
        if (
            !$this->service->validateEmail($input->getArgument('email'))
        ) {
            $outputMessage = sprintf(
                'There is a problem. Email %s is not valid!',
                $input->getArgument('email')
            );
        } else {
            $outputMessage = sprintf(
                'There is good news. Email %s is valid!',
                $input->getArgument('email')
            );
        }
        $output->writeln($outputMessage);

        return Command::SUCCESS;
    }
}