<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EmailValidator;

use App\Shared\Application\Interfaces\EmailValidate;

class SendPostEmailValidator implements EmailValidate
{    
    public function validate(string $email): bool
    {
        return true;
    }
}
