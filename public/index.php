<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Entities\Factions\FactionMembership;
use App\Factories\CharacterFactory;
use App\Factories\FactionFactory;

echo "<h1>Hello, and welcome to the RPG Kata!<h1> <h4>Pull up a chair and grab a mug of ale!</h4>";

$characterOne = CharacterFactory::make('Tony the Tank');
$characterTwo = CharacterFactory::make('Hector the Hero');
$characterThree = CharacterFactory::make('Bartholomew the Brave');

$phoenixOrder = FactionFactory::make('The Order of the Phoenix');
$steelFalcons = FactionFactory::make('The Steel Falcons');

$factionMembership = new FactionMembership();
$factionMembership->join($phoenixOrder, $characterOne);
$factionMembership->join($phoenixOrder, $characterTwo);
$factionMembership->join($steelFalcons, $characterThree);

echo "<p>The Order of the Phoenix has {$factionMembership->memberCount($phoenixOrder)} members.<p>";
echo "<p>The Steel Falcons has {$factionMembership->memberCount($steelFalcons)} members.</p>";