<?php

declare(strict_types=1);

namespace App\Tests\Unit\Services;

use App\Entities\Character;
use App\Entities\Damage;
use App\Entities\Factions\FactionMembership;
use App\Services\BattleService;
use PHPUnit\Framework\TestCase;

class BattleServiceTest extends TestCase
{
    public function testAlliesCannotAttackAllies(): void
    {
        $factionMembership = $this->createMock(FactionMembership::class);
        $factionMembership
            ->expects($this->once())
            ->method('areAllied')
            ->willReturn(true);

        $battleService = new BattleService($factionMembership);
        $result = $battleService->canAttack(new Character('Thor'), new Character('Iron Man'));

        $this->assertFalse($result);
    }

    public function testAlliesCanAttackNonAllies(): void
    {
        $factionMembership = $this->createMock(FactionMembership::class);
        $factionMembership
            ->expects($this->once())
            ->method('areAllied')
            ->willReturn(false);

        $battleService = new BattleService($factionMembership);
        $result = $battleService->canAttack(new Character('Black Widow'), new Character('Thanos'));

        $this->assertTrue($result);
    }

    public function testCannotAttackDeadCharacters(): void
    {
        $battleService = new BattleService(new FactionMembership());

        $attacker = new Character('Thanos');
        $deadCharacter = new Character('Spider-Man');

        $dmg = new Damage($attacker, $deadCharacter, $deadCharacter->getHealth() + 10);

        $deadCharacter->takeDamage($dmg);

        $result = $battleService->canAttack($attacker, $deadCharacter);

        $this->assertFalse($result);
    }

    public function testAlliesCannotHealEnemies(): void
    {
        $factionMembership = $this->createMock(FactionMembership::class);
        $factionMembership
            ->expects($this->once())
            ->method('areAllied')
            ->willReturn(false);

        $battleService = new BattleService($factionMembership);
        $result = $battleService->canHeal(new Character('Iron man'), new Character('Thanos'));

        $this->assertFalse($result);
    }

    public function testAlliesCanHealAllies(): void
    {
        $factionMembership = $this->createMock(FactionMembership::class);
        $factionMembership
            ->expects($this->once())
            ->method('areAllied')
            ->willReturn(true);

        $battleService = new BattleService($factionMembership);
        $result = $battleService->canHeal(new Character('Starlord'), new Character('Groot'));

        $this->assertTrue($result);
    }

    public function testCannotHealDeadCharacters(): void
    {
        $battleService = new BattleService(new FactionMembership());

        $healer = new Character('Mantis');
        $deadCharacter = new Character('Drax');

        $dmg = new Damage($healer, $deadCharacter, $deadCharacter->getHealth() + 10);

        $deadCharacter->takeDamage($dmg);

        $result = $battleService->canHeal($healer, $deadCharacter);

        $this->assertFalse($result);
    }

    public function testAttackReturnsDamage(): void
    {
        $battleService = $this
            ->getMockBuilder(BattleService::class)
            ->onlyMethods(['canAttack'])
            ->disableOriginalConstructor()
            ->getMock();

        $battleService
            ->expects($this->once())
            ->method('canAttack')
            ->willReturn(true);

        $attacker = new Character('Hulk');
        $target = new Character('Loki');
        $damageAmount = 10;

        $damage = $battleService->attack($attacker, $target, $damageAmount);
        $this->assertInstanceOf(Damage::class, $damage);
        $this->assertEquals($damageAmount, $damage->getAmount());
    }

    public function testHealReturnsHealth(): void
    {
        $battleService = $this
            ->getMockBuilder(BattleService::class)
            ->onlyMethods(['canHeal'])
            ->disableOriginalConstructor()
            ->getMock();

        $battleService
            ->expects($this->once())
            ->method('canHeal')
            ->willReturn(true);

        $healer = new Character('Valkyrie');
        $target = new Character('Dr Strange');
        $healAmount = 10;

        $hp = $battleService->heal($healer, $target, $healAmount);
        $this->assertEquals($target->getHealth(), $hp);
    }
}
