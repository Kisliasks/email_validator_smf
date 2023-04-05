<?php

declare(strict_types=1);

namespace App\Shared\Application\Interfaces;

interface ValidatorServiceInterface
{
    /**
     * @param string $email
     * @param string $mode
     * @return bool
     */
    public function validateEmail(string $email, string $mode): bool;
}
