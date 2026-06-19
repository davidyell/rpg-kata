<?php

declare(strict_types=1);

namespace App\Factories;

use App\Entities\Character;

class CharacterFactory implements FactoryInterface
{
    public static function make(...$args): Character
    {
        return new Character();
    }
}
