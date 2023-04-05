<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service\Validator\EmailValidator\Components;

use App\Shared\Application\Interfaces\EmailValidateInterface;

class SendPostEmailValidator implements EmailValidateInterface
{    
    public function validate(string $email): bool
    {
        return true;
    }
}
