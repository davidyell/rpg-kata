<?php

declare(strict_types=1);

namespace App\Tests\unit\Entities;

use App\Entities\Character;
use App\Entities\Damage;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    public function testTakeDamageWithinRange(): void
    {
        $attacker = new Character('Jerry');
        $defender = new Character('Jinny');

        $dmg = new Damage($attacker, $defender, 100);

        $defender->takeDamage($dmg);

        $this->assertEquals(900, $defender->getHealth());
    }

    public function testTakeOverkillDamage(): void
    {
        $attacker = new Character('Jerry');
        $defender = new Character('Jinny');

        $dmg = new Damage($attacker, $defender, 9001);

        $defender->takeDamage($dmg);

        $this->assertTrue($defender->isDead());
    }
}
