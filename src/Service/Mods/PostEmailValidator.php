<?php

declare(strict_types=1);

namespace App\Service\Mods;

use App\Application\Interfaces\EmailValidateInterface;

class PostEmailValidator implements EmailValidateInterface
{
    /**
     * @param string $email
     * @return bool
     */
    public function validate(string $email): bool
    {
        return true;
    }
}
