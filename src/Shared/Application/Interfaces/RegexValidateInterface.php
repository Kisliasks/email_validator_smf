<?php

declare(strict_types=1);

namespace App\Shared\Application\Interfaces;

interface RegexValidateInterface extends BaseValidateInterface
{
    public function validateWithRegex(string $email): bool;
}
