<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EmailValidator;

use App\Shared\Application\Interfaces\EmailValidate;

class RegexEmailValidator implements EmailValidate
{
    public function validate(string $email): bool
    {
        if (preg_match('/.+@.+\..+/i', $email)) {
            return true;
        }
        
        return false;
    }
}
