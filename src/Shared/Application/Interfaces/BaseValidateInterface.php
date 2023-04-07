<?php

declare(strict_types=1);

namespace App\Shared\Application\Interfaces;

interface BaseValidateInterface
{
    /**
     * @param string $email
     * @return bool
     */
    public function validateWithSpamDataBase(string $email): bool;

    public function validateWithPost(string $email): bool;
}
