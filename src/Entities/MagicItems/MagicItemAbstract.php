<?php

declare(strict_types=1);

namespace App\Entities\MagicItems;

use App\Contracts\MagicItems\MagicItemInterface;

abstract class MagicItemAbstract implements MagicItemInterface
{
    public function __construct(
        protected int $health, 
    )
    {}
    
    public function getHealth(): int
    {
        return $this->health;
    }

    public function isDestroyed(): bool
    {
        return $this->health <= 0;
    }
}
