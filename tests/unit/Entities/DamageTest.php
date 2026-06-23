<?php

declare(strict_types=1);

namespace App\Tests\unit\Entities;

use App\Entities\Character;
use App\Entities\Damage;
use PHPUnit\Framework\TestCase;

class DamageTest extends TestCase
{
    public function testDamageAmountWhenAttackerIsHigherLevel(): void
    {
        $attacker = $this->createMock(Character::class);
        $attacker
            ->expects($this->once())
            ->method('getLevel')
            ->willReturn(10);

        $defender = $this->createMock(Character::class);
        $defender
            ->expects($this->once())
            ->method('getLevel')
            ->willReturn(5);

        $damage = new Damage($attacker, $defender, 100);
        $this->assertEquals(150, $damage->getAmount());
    }

    public function testDamageAmountWhenDefenderIsHigherLevel(): void
    {
        $attacker = $this->createMock(Character::class);
        $attacker
            ->expects($this->exactly(2))
            ->method('getLevel')
            ->willReturn(10);

        $defender = $this->createMock(Character::class);
        $defender
            ->expects($this->exactly(2))
            ->method('getLevel')
            ->willReturn(20);

        $damage = new Damage($attacker, $defender, 100);
        $this->assertEquals(50, $damage->getAmount());
    }

    public function testDamageAmountWhenLevelsAreEqual(): void
    {
        $attacker = $this->createMock(Character::class);
        $attacker
            ->expects($this->exactly(2))
            ->method('getLevel')
            ->willReturn(10);

        $defender = $this->createMock(Character::class);
        $defender
            ->expects($this->exactly(2))
            ->method('getLevel')
            ->willReturn(10);

        $damage = new Damage($attacker, $defender, 100);
        $this->assertEquals(100, $damage->getAmount());
    }
}
