<?php

namespace App\Shared\Application\Command;

use App\Shared\Domain\Entity\EmailValidator\RegexEmailValidator;
use App\Shared\Domain\Entity\EmailValidator\SendPostEmailValidator;
use App\Shared\Domain\Entity\EmailValidator\SpamDatabaseEmailValidator;
use App\Shared\Domain\Service\EmailValidateService;
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
        $validator = new EmailValidateService;

        $validator->addDriver(new RegexEmailValidator, 'regex');
        $validator->addDriver(new SendPostEmailValidator, 'post');
        $validator->addDriver(new SpamDatabaseEmailValidator, 'spam');

        $validator->setDriver('regex');
        $regexValidateResult = $validator->validate($input->getArgument('email'));

        $validator->setDriver('post');
        $postValidateResult = $validator->validate($input->getArgument('email'));

        $validator->setDriver('spam');
        $spamValidateResult = $validator->validate($input->getArgument('email'));

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