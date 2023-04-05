<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service\Validator\EmailValidator\Components;

use App\Shared\Application\Interfaces\EmailValidateInterface;

class RegexEmailValidator implements EmailValidateInterface
{
    public function validate(string $email): bool
    {
        if (preg_match('/.+@.+\..+/i', $email)) {
            return true;
        }
        
        return false;
    }
}
