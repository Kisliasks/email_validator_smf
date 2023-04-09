<?php

declare(strict_types=1);

namespace App\Service;

use App\Application\Interfaces\EmailValidateInterface;

class EmailValidateService
{
    /**
     * @var array<EmailValidateInterface>
     */
    private array $validators;

    public function __construct(array $validators)
    {
        $this->validators = $validators;
    }

    public function validateEmail(string $email): bool
    {
        foreach ($this->validators as $validator) {
            if (!$validator->validate($email)) {
                return false;
            }
        }

        return true;
    }
}
