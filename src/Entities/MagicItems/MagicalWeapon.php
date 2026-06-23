<?php

declare(strict_types=1);

namespace App\Entities\MagicItems;

use App\Contracts\MagicItems\CanDamageInterface;

class MagicalWeapon extends MagicItemAbstract implements CanDamageInterface
{
    public function __construct(int $health, private int $damage = 1)
    {
        parent::__construct($health);
    }

    public function dealsDamage(): int
    {
        return $this->damage;
    }
}
