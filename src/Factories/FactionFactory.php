<?php

declare(strict_types=1);

namespace App\Factories;

use App\Entities\Faction;

class FactionFactory implements FactoryInterface
{
    public static function make(...$args): Faction
    {
        return new Faction($args[0]);
    }
}
