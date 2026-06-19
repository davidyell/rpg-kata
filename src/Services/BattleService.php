<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\Character;
use App\Entities\Damage;
use App\Entities\FactionMembership;

/**
 * Allows characters to battle each other
 */
class BattleService
{
    public function __construct(
        private readonly FactionMembership $factionMembership
    )
    {}

    /**
     * Have a character try and attack another character.
     *
     * @param Character $attacker
     * @param Character $target
     * @param integer $damageAmount
     * @return Damage|null
     */
    public function attack(Character $attacker, Character $target, int $damageAmount): Damage|null
    {
        if ($this->canAttack($attacker, $target)) {
            $damage = new Damage($attacker, $target, $damageAmount);
            $target->takeDamage($damage);

            return $damage;
        }

        return null;
    }

    /**
     * Have a character try and heal another character.
     *
     * @param Character $healer
     * @param Character $target
     * @param integer $healAmount
     * @return int The target characters HP after healing
     */
    public function heal(Character $healer, Character $target, int $healAmount): int
    {
        if ($this->canHeal($healer, $target)) {
            $target->heal($healAmount);
        }

        return $target->getHealth();
    }

    /**
     * Check if a character is allowed to attack another.
     * 
     * Characters cannot attack their allies in the same faction or attack dead characters.
     *
     * @param Character $attacker
     * @param Character $target
     * @return boolean
     */
    public function canAttack(Character $attacker, Character $target): bool
    {
        if ($target->isDead() || $this->factionMembership->areAllied($attacker, $target)) {
            return false;
        }

        return true;
    }

    /**
     * Check if a character is allowed to heal
     * 
     * Characters can only heal allies in the same faction or heal themselves.
     * Characters cannot heal dead allies.
     *
     * @param Character $healer
     * @param Character $target
     * @return boolean
     */
    public function canHeal(Character $healer, Character $target): bool
    {
        if ($target->isDead() || !$this->factionMembership->areAllied($healer, $target)) {
            return false;
        }

        return true;
    }
}
