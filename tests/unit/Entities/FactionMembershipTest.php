<?php

declare(strict_types=1);

namespace App\Test\unit\Entities;

use App\Entities\Character;
use App\Entities\Factions\FactionInterface;
use App\Entities\Factions\FactionMembership;
use PHPUnit\Framework\TestCase;

class FactionMembershipTest extends TestCase
{
    public function testJoin(): void
    {
        $factionMembership = new FactionMembership();
        $faction = $this->createStub(FactionInterface::class);
        $character = $this->createStub(Character::class);
        
        $factionMembership->join($faction, $character);
        $this->assertEquals(1, $factionMembership->memberCount($faction));
    }

    public function testIsMember(): void
    {
        $factionMembership = new FactionMembership();
        $faction = $this->createStub(FactionInterface::class);
        $character = $this->createStub(Character::class);

        $factionMembership->join($faction, $character);
        $this->assertTrue($factionMembership->isMember($faction, $character));
    }

    public function testIsNotMember(): void
    {
        $factionMembership = new FactionMembership();
        $faction = $this->createStub(FactionInterface::class);
        $character = $this->createStub(Character::class);

        $this->assertFalse($factionMembership->isMember($faction, $character));
    }

    public function testAreAllied(): void
    {
        $factionMembership = new FactionMembership();
        $faction = $this->createStub(FactionInterface::class);
        $character1 = $this->createStub(Character::class);
        $character2 = $this->createStub(Character::class);

        $factionMembership->join($faction, $character1);
        $factionMembership->join($faction, $character2);

        $this->assertTrue($factionMembership->areAllied($character1, $character2));
    }

    public function testAreNotAllied(): void
    {
        $factionMembership = new FactionMembership();
        $faction = $this->createStub(FactionInterface::class);
        $character1 = $this->createStub(Character::class);
        $character2 = $this->createStub(Character::class);
        $character3 = $this->createStub(Character::class);

        $factionMembership->join($faction, $character1);
        $factionMembership->join($faction, $character2);

        $this->assertFalse($factionMembership->areAllied($character1, $character3));
    }

    public function testLeave(): void
    {
        $factionMembership = new FactionMembership();
        $faction = $this->createStub(FactionInterface::class);
        $character = $this->createStub(Character::class);
        
        $factionMembership->join($faction, $character);
        $this->assertEquals(1, $factionMembership->memberCount($faction));

        $factionMembership->leave($faction, $character);
        $this->assertEquals(0, $factionMembership->memberCount($faction));
    }

    public function testLeavingAFactionYoureNotIn(): void
    {
        $factionMembership = $this->getMockBuilder(FactionMembership::class)
            ->onlyMethods(['factionExists'])
            ->getMock();

        $faction = $this->createStub(FactionInterface::class);
        $character = $this->createStub(Character::class);
        
        $factionMembership
            ->expects($this->once())
            ->method('factionExists')
            ->with($faction);

        $factionMembership->leave($faction, $character);
    }

    public function testMemberCounts(): void
    {
        $factionMembership = new FactionMembership();

        $faction = $this->createStub(FactionInterface::class);
        $faction2 = $this->createStub(FactionInterface::class);

        $character1 = $this->createStub(Character::class);
        $character2 = $this->createStub(Character::class);
        $character3 = $this->createStub(Character::class);

        $factionMembership->join($faction, $character1);
        $factionMembership->join($faction, $character2);
        $factionMembership->join($faction2, $character3);

        $this->assertEquals(2, $factionMembership->memberCount($faction));
        $this->assertEquals(1, $factionMembership->memberCount($faction2));
    }
}
