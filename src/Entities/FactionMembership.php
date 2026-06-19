<?php

declare(strict_types=1);

namespace App\Entities;

class FactionMembership
{
    /**
     * Store which characters are in with faction
     *
     * @var array<string, Character[]> 
     */
    private $memberships = [];

    /**
     * Add the passed character to the faction
     *
     * @param FactionInterface $faction
     * @param Character $character
     * @return void
     */
    public function join(FactionInterface $faction, Character $character): void
    {
        $this->memberships[spl_object_id($faction)][] = $character;
    }

    /**
     * Check if a character is a member of the faction
     *
     * @param FactionInterface $faction
     * @param Character $character
     * @return boolean
     */
    public function isMember(FactionInterface $faction, Character $character): bool
    {
        return in_array($character, $this->memberships[spl_object_id($faction)], true);
    }

    /**
     * Check if two characters are in the same faction
     *
     * @param Character $firstChar
     * @param Character $secondChar
     * @return boolean
     */
    public function areAllied(Character $firstChar, Character $secondChar): bool
    {
        foreach ($this->memberships as $factionId => $characters) {
            if (in_array($firstChar, $characters, true) && in_array($secondChar, $characters, true)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Remove the passed character from the faction
     *
     * @param FactionInterface $faction
     * @param Character $character
     * @return void
     */
    public function leave(FactionInterface $faction, Character $character): void
    {
        $key = array_search($character, $this->memberships[spl_object_id($faction)], true);
        if ($key !== false) {
            unset($this->memberships[spl_object_id($faction)][$key]);
        }
    }

    /**
     * Count members in a faction
     *
     * @param FactionInterface $faction
     * @return integer
     */
    public function memberCount(FactionInterface $faction): int
    {
        $count = 0;
        if (isset($this->memberships[spl_object_id($faction)])) {
            $count = count($this->memberships[spl_object_id($faction)]);
        }
        return $count;
    }
}
