<?php

namespace App\Tests\Functional\Controller;

use App\Shared\Domain\Service\Validator\ValidatorService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ValidateEmailTest extends WebTestCase
{
    private $validator;

    public function setUp(): void
    {
        $this->validator = new ValidatorService;
    }

    public function testValidationWithRegex(): void
    {
        $this->assertFalse($this->validator->validateEmail('test.com', 'regex'));

        $this->assertTrue($this->validator->validateEmail('test@gmail.com', 'regex'));
    }

    public function testValidationModeNotAvailable(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unknown mail validation method "notAvailableMode"');

        $this->validator->validateEmail('test@gmail.com', 'notAvailableMode');
    }

    public function testValidationWithSendPost(): void
    {
        $this->assertTrue($this->validator->validateEmail('test@gmail.com', 'post'));
    }

    /**
     * Если почта обнаружилась в спам-базе, она является невалидной.
     * Для проверки отрицательного значения, используем email из SpamDatabaseEmailValidator
     */
    public function testValidationWithSpamDatabase(): void
    {
        $this->assertTrue($this->validator->validateEmail('test@gmail.com', 'spam'));

        $this->assertFalse($this->validator->validateEmail('mike@mail.ru', 'spam'));
    }
}
