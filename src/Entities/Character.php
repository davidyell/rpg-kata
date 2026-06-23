<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\Damage;

/**
 * @phpstan-type CharacterName non-empty-string
 * @phpstan-type CharacterHealth int<0, 1500>
 */
class Character
{
    const HP_LEVEL_UNDER_6 = 1000;
    const HP_MAX = 1500;

    /**
     * Characters health
     *
     * @var CharacterHealth
     */
    private int $health = self::HP_LEVEL_UNDER_6;

    /**
     * Characters level
     *
     * @var non-negative-int
     */
    private int $level = 1;

    public function __construct(
        /** @var CharacterName $name */
        private string $name
    )
    {
        $this->health = self::HP_LEVEL_UNDER_6;
        
        if ($this->level >= 6) {
            $this->health = self::HP_MAX;
        }
    }

    /**
     * Get the characters name
     *
     * @return CharacterName
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the characters health
     *
     * @return CharacterHealth
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
        $this->health = min(self::HP_MAX, max(0, $this->getHealth() - $damage->getAmount()));
    }

    /**
     * Heal the characters HP
     *
     * @param positive-int $amount
     * @return void
     */
    public function heal(int $amount): void
    {
        $this->health = min(self::HP_MAX, max(0, $this->getHealth() + $amount));
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

    /**
     * What is the characters current level?
     *
     * @return integer
     */
    public function getLevel(): int
    {
        return $this->level;
    }
}
