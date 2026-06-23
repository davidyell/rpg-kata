<?php

declare(strict_types=1);

namespace App\Contracts\MagicItems;

interface CanHealInterface
{
    /**
     * A magical healing item can heal for 
     * as much HP as the items has health
     *
     * @return integer
     */
    public function healsFor(): int;
}
