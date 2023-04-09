<?php

namespace App\Tests\Functional\Controller;

use App\Service\EmailValidateService;
use App\Service\Mods\PostEmailValidator;
use App\Service\Mods\RegexEmailValidator;
use App\Service\Mods\SpamDatabaseEmailValidator;
use PHPUnit\Framework\TestCase;

class ValidateEmailTest extends TestCase
{
    private $validator;

    public function setUp(): void
    {
        $this->validator = new EmailValidateService([
            new RegexEmailValidator,
            new SpamDatabaseEmailValidator,
            new PostEmailValidator
        ]);
    }

    public function testValidationWithRegex(): void
    {
        $this->assertFalse($this->validator->validateEmail('test.com'));

        $this->assertTrue($this->validator->validateEmail('test@gmail.com'));
    }

    public function testValidationWithSendPost(): void
    {
        $this->assertTrue($this->validator->validateEmail('test@gmail.com'));
    }

    /**
     * Если почта обнаружилась в спам-базе, она является невалидной.
     * Для проверки отрицательного значения, используем email из SpamDatabaseEmailValidator
     */
    public function testValidationWithSpamDatabase(): void
    {
        $this->assertTrue($this->validator->validateEmail('test@gmail.com'));

        $this->assertFalse($this->validator->validateEmail('mike@mail.ru'));
    }
}
