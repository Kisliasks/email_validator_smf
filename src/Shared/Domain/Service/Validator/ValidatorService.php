<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service\Validator;

use App\Shared\Application\Interfaces\ValidatorServiceInterface;
use App\Shared\Domain\Service\Validator\EmailValidator\EmailValidateService;

class ValidatorService implements ValidatorServiceInterface
{
    /**
     * @param string $email
     * @param string $mode
     * @return bool
     * available mods: regex, post, spam
     */
    public function validateEmail(string $email, string $mode): bool
    {
        /** @var EmailValidateService $validator */
        $validator = new EmailValidateService($mode);

        return $validator->validate($email);  
    }
}
