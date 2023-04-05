<?php

declare(strict_types=1);

namespace App\Shared\Application\Interfaces;

interface EmailValidate
{
    /**
     * @param string $email
     * @return bool
     */
    public function validate(string $email): bool;
}
