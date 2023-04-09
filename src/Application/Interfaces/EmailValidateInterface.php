<?php

declare(strict_types=1);

namespace App\Application\Interfaces;

interface EmailValidateInterface
{
    public function validate(string $email): bool;
}
