<?php

declare(strict_types=1);

namespace App\Entities\Factions;

class Faction implements FactionInterface
{
    public function __construct(
        private string $name,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
