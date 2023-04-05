<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service\Validator\EmailValidator\Components;

use App\Shared\Application\Interfaces\EmailValidateInterface;

abstract class AbstractEmailValidateService implements EmailValidateInterface
{
    private EmailValidateInterface $mode;

    public function __construct(EmailValidateInterface $mode)
    {
        $this->mode = $mode;
    }
    
    public function validate(string $email): bool
    {
        return $this->mode->validate($email);
    }
}
