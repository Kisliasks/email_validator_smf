<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entity\EmailValidator;

use App\Shared\Application\Interfaces\EmailValidate;

class SpamDatabaseEmailValidator implements EmailValidate
{    
    public function validate(string $email): bool
    {
        if (
            in_array($email, $this->getSpamData(), true)
        ) {
            return false;
        }

        return true;
    }

    private function getSpamData(): array
    {
        return [
            'mike@mail.ru',
            'tonny@gmail.com',
            'killer@gmail.com',
            'mary.job@mail.ru',
        ];
    }
}
