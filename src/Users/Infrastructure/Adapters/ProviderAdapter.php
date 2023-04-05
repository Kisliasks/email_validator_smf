<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Adapters;

use App\Provider\Infrastructure\API\API;

class ProviderAdapter
{
    public function __construct(private readonly API $provider)
    {

    }

    public function getSomeData(): array
    {
        $this->provider->getSomeData();

        return [];
    }
}
