<?php

declare(strict_types=1);

namespace App\Factories;

use App\Entities\Character;

class CharacterFactory
{
    /**
     * Create a new character
     * 
     * Usage: CharacterFactory::make('Sparkles the Mystical')
     *
     * @param string $name Pass the characters name
     * @return Character
     */
    public static function make($name): Character
    {
        return new Character($name);
    }
}
