<?php

namespace App\Shared\Application\Command;

use App\Shared\Domain\Components\EmailValidator\RegexEmailValidator;
use App\Shared\Domain\Components\EmailValidator\SendPostEmailValidator;
use App\Shared\Domain\Components\EmailValidator\SpamDatabaseEmailValidator;
use App\Shared\Domain\Service\Validator\ValidatorService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EmailValidationCommand extends Command
{
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
        $validator = new ValidatorService;

        $regexValidateResult = $validator->validateEmail(
            $input->getArgument('email'),
            'regex'
        );
        $postValidateResult = $validator->validateEmail(
            $input->getArgument('email'),
            'post'
        );
        $spamValidateResult = $validator->validateEmail(
            $input->getArgument('email'),
            'spam'
        );

        if (
            !$regexValidateResult ||
            !$postValidateResult ||
            !$spamValidateResult
        ) {
            $outputMessage = sprintf('There is a problem. Email %s is not valid!', $input->getArgument('email'));
        } else {
            $outputMessage = sprintf('There is good news. Email %s is valid!', $input->getArgument('email'));
        }
        $output->writeln($outputMessage);

        return Command::SUCCESS;
    }
}