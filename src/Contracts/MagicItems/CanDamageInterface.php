<?php

declare(strict_types=1);

namespace App\Contracts\MagicItems;

interface CanDamageInterface
{
    /**
     * Magical items which can deal damage will deal 
     * a fixed amount of damage each time
     *
     * @return integer
     */
    public function dealsDamage(): int;
}
