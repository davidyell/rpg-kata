<?php

declare(strict_types=1);

namespace App\Entities;

class Damage
{
    /**
     * An instance of damage, which should be immutable
     *
     * @param positive-int $amount
     * @param Character $attacker
     * @param Character $target
     */
    public function __construct(
        public readonly Character $attacker,
        public readonly Character $target,
        public readonly int $amount,
    ) {
    }

    /**
     * Get the calculated amount of damage
     *
     * @return integer|float
     */
    public function getAmount(): int|float
    {
        $amount = $this->amount;

        // If attacker is 5 levels above target dmg +50%
        if ($this->attacker->getLevel() >= $this->target->getLevel() + 5) {
            $amount *= 1.5;
        // If attacker is 5 levels or below the target dmg -50%
        } else if ($this->attacker->getLevel() <= $this->target->getLevel() - 5) {
            $amount *= 0.5;
        }

        return $amount;
    }
}
