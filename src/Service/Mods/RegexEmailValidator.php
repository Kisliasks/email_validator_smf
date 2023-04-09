<?php

declare(strict_types=1);

namespace App\Service\Mods;

use App\Application\Interfaces\EmailValidateInterface;

class RegexEmailValidator implements EmailValidateInterface
{
    /**
     * @param string $email
     * @return bool
     */
    public function validate(string $email): bool
    {
        if (preg_match('/.+@.+\..+/i', $email)) {
            return true;
        }
        
        return false;
    }
}
