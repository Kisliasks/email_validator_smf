<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service\Validator\EmailValidator;

use App\Shared\Application\Interfaces\BaseValidateInterface;

/**
 * Базовый класс валидации email
 */
class BaseValidateService implements BaseValidateInterface
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
    public function validateWithSpamDataBase(string $email): bool
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

    /**
     * @param string $email
     * @return bool
     */
    public function validateWithPost(string $email): bool
    {
        return true;
    }
}
