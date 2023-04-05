<?php

namespace App\Tests\Functional\Controller;

use App\Shared\Domain\Service\EmailValidateService;
use App\Shared\Infrastructure\EmailValidator\RegexEmailValidator;
use App\Shared\Infrastructure\EmailValidator\SendPostEmailValidator;
use App\Shared\Infrastructure\EmailValidator\SpamDatabaseEmailValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ValidateEmailTest extends WebTestCase
{
    private $validator;

    public function setUp(): void
    {
        $this->validator = new EmailValidateService();
    }

    public function testValidationWithRegex(): void
    {
        $this->validator->addDriver(new RegexEmailValidator, 'regex');

        $this->validator->setDriver('regex');

        $this->assertFalse($this->validator->validate('test.com'));

        $this->assertTrue($this->validator->validate('test@gmail.com'));
    }

    public function testValidationWithSendPost(): void
    {
        $this->validator->addDriver(new SendPostEmailValidator, 'post');

        $this->validator->setDriver('post');

        $this->assertTrue($this->validator->validate('test@gmail.com'));
    }

    /**
     * Если почта обнаружилась в спам-базе, она является невалидной.
     * Для проверки отрицательного значения, используем email из SpamDatabaseEmailValidator
     */
    public function testValidationWithSpamDatabase(): void
    {
        $this->validator->addDriver(new SpamDatabaseEmailValidator, 'spam');

        $this->validator->setDriver('spam');

        $this->assertTrue($this->validator->validate('test@gmail.com'));

        $this->assertFalse($this->validator->validate('mike@mail.ru'));
    }
}
