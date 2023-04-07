<?php

declare(strict_types=1);

namespace App\Shared\Service\Mods;

use App\Shared\Application\Interfaces\RegexValidateInterface;
use App\Shared\Domain\Service\Validator\EmailValidator\BaseValidateService;

/**
 * Расширяет базовый класс валидации
 */
class RegexValidateService extends BaseValidateService implements RegexValidateInterface
{
    /**
     * @param string $email
     * @return bool
     */
    public function validateWithRegex(string $email): bool
    {
        if (preg_match('/.+@.+\..+/i', $email)) {
            return true;
        }
        
        return false;
    }
}
