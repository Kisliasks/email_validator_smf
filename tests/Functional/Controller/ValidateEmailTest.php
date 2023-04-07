<?php

namespace App\Tests\Functional\Controller;

use App\Shared\Service\Mods\RegexValidateService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ValidateEmailTest extends WebTestCase
{
    private $validator;

    public function setUp(): void
    {
        $this->validator = new RegexValidateService();
    }

    public function testValidationWithRegex(): void
    {
        $this->assertFalse($this->validator->validateWithRegex('test.com'));

        $this->assertTrue($this->validator->validateWithRegex('test@gmail.com'));
    }

    public function testValidationWithSendPost(): void
    {
        $this->assertTrue($this->validator->validateWithPost('test@gmail.com'));
    }

    /**
     * Если почта обнаружилась в спам-базе, она является невалидной.
     * Для проверки отрицательного значения, используем email из SpamDatabaseEmailValidator
     */
    public function testValidationWithSpamDatabase(): void
    {
        $this->assertTrue($this->validator->validateWithSpamDataBase('test@gmail.com'));

        $this->assertFalse($this->validator->validateWithSpamDataBase('mike@mail.ru'));
    }
}
