<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service\Validator\EmailValidator;

use App\Shared\Application\Interfaces\BaseValidateInterface;
use App\Shared\Application\Interfaces\RegexValidateInterface;

class RegexValidateService extends BaseValidateService implements BaseValidateInterface, RegexValidateInterface
{
    /**
     * @param string $email
     * @return bool
     */
    public function validateWithSpamDataBase(string $email): bool
    {
        return $this->validateWithSpamDataBase($email);
    }

    /**
     * @param string $email
     * @return bool
     */
    public function validateWithPost(string $email): bool
    {
        return $this->validateWithPost($email);
    }

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
