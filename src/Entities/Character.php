<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\Damage;

class Character
{
    private int $health = 1000;
    private int $level = 1;

    public function __construct(
        private string $name
    )
    {
        $this->health = 1000;
        
        if ($this->level >= 6) {
            $this->health = 1500;
        }
    }

    /**
     * Get the characters name
     *
     * @return string
     */
    public function getName(): string 
    {
        return $this->name;
    }

    /**
     * Get the characters health
     *
     * @return int<0, 1000>
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * Take an amount of damage
     *
     * @param Damage $damage An instance of damage
     * @return void
     */
    public function takeDamage(Damage $damage): void
    {
        $this->health = $this->getHealth() - $damage->getAmount();
    }

    /**
     * Undocumented function
     *
     * @param positive-int $amount
     * @return void
     */
    public function heal(int $amount): void
    {
        $this->health = $this->getHealth() + $amount;
    }

    /**
     * Is the character dead?
     *
     * @return boolean
     */
    public function isDead(): bool
    {
        return $this->getHealth() <= 0;
    }

    public function getLevel(): int
    {
        return $this->level;
    }
}
