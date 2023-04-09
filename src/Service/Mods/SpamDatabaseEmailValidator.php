<?php

declare(strict_types=1);

namespace App\Service\Mods;

use App\Application\Interfaces\EmailValidateInterface;

class SpamDatabaseEmailValidator implements EmailValidateInterface
{
    private const SPAM_EMAILS = [
        'mike@mail.ru',
        'tonny@gmail.com',
        'killer@gmail.com',
        'mary.job@mail.ru',
    ];

    /**
     * @param string $email
     * @return bool
     */
    public function validate(string $email): bool
    {
        if (
            in_array(
                $email,
                self::SPAM_EMAILS,
                true
            )
        ) {
            return false;
        }

        return true;
    }
}
