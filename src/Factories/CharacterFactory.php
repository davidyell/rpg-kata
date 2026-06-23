<?php

declare(strict_types=1);

namespace App\Factories;

use App\Entities\Character;

/**
 * @phpstan-import-type CharacterName from Character
 */
class CharacterFactory
{
    /**
     * Create a new character
     * 
     * Usage: CharacterFactory::make('Sparkles the Mystical')
     *
     * @param CharacterName $name Pass the characters name
     * @return Character
     */
    public static function make(string $name): Character
    {
        return new Character($name);
    }
}
