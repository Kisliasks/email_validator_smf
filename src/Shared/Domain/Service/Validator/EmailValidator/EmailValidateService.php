<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service\Validator\EmailValidator;

use App\Shared\Domain\Service\Validator\EmailValidator\Components\AbstractEmailValidateService;
use App\Shared\Domain\Service\Validator\EmailValidator\Components\RegexEmailValidator;
use App\Shared\Domain\Service\Validator\EmailValidator\Components\SendPostEmailValidator;
use App\Shared\Domain\Service\Validator\EmailValidator\Components\SpamDatabaseEmailValidator;
use Exception;

class EmailValidateService extends AbstractEmailValidateService
{
    /**
     * Способ валидации
     * @var string $mode
     */
    private string $mode;

    private const AVAILABLE_MODS = [
        'regex' => RegexEmailValidator::class,
        'post' => SendPostEmailValidator::class,
        'spam' => SpamDatabaseEmailValidator::class,
    ];

    public function __construct(string $mode)
    {
        if (!isset(self::AVAILABLE_MODS[$mode])) {
            throw new Exception(
                sprintf('Unknown mail validation method "%s"', $mode)
            );
        }

        $this->mode = $mode;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function validate(string $email): bool
    {
        $class = self::AVAILABLE_MODS[$this->mode];

        /** @var AbstractEmailValidateService $emailValidator */
         $emailValidator = new $class($this->mode);

        return $emailValidator->validate($email);
    }
}
