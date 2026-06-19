<?php

declare(strict_types=1);

namespace App\Factories;

use App\Entities\Character;
use App\Entities\FactionInterface;

interface FactoryInterface
{
    /**
     * @param mixed $args
     */
    public static function make(...$args): Character|FactionInterface;
}
