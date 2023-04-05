<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

use App\Shared\Application\Interfaces\EmailValidate;

class EmailValidateService
{
    private string $driver = '';
    /**
     * @var array<string, EmailValidate>
     */
    private array $drivers = [];

    public function addDriver(EmailValidate $driver, string $driverName): void
    {
        $this->drivers[$driverName] = $driver;
    }

    public function setDriver(string $driver): void
    {
        $this->driver = $driver;
    }

    public function validate(string $email): bool
    {
        return $this->drivers[$this->driver]->validate($email);
    }
}
