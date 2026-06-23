<?php

declare(strict_types=1);

namespace App\Factories;

use App\Entities\Factions\Faction;

class FactionFactory
{
    /**
     * Create a new faction
     * 
     * Usage: FactionFactory::make('Chapter of the White Swan')
     *
     * @param string $name Pass the name of the faction
     * @return Faction
     */
    public static function make(string $name): Faction
    {
        return new Faction($name);
    }
}
