<?php

declare(strict_types=1);

namespace App\Entities\MagicItems;

use App\Contracts\MagicItems\CanHealInterface;
use App\Entities\MagicItems\MagicItemAbstract;

class MagicHealingItem extends MagicItemAbstract implements CanHealInterface
{
    public function __construct(int $health)
    {
        parent::__construct($health);
    }

    public function healsFor(): int
    {
        return $this->health;
    }
}
