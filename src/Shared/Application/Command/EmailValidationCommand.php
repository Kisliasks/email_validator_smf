<?php

namespace App\Shared\Application\Command;

use App\Shared\Application\Interfaces\RegexValidateInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EmailValidationCommand extends Command
{
    public function __construct(
        private readonly RegexValidateInterface $validator
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
        $postValidateResult = $this->validator->validateWithPost(
            $input->getArgument('email')
        );
        $regexValidateResult = $this->validator->validateWithRegex(
            $input->getArgument('email')
        );
        $spamValidateResult = $this->validator->validateWithSpamDataBase(
            $input->getArgument('email')
        );

        if (
            !$regexValidateResult ||
            !$postValidateResult ||
            !$spamValidateResult
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