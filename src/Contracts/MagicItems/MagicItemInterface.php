<?php

declare(strict_types=1);

namespace App\Contracts\MagicItems;

interface MagicItemInterface
{
    public function __construct(int $health);
    public function getHealth(): int;
    public function isDestroyed(): bool;
}
