<?php declare(strict_types=1);
define("__ROOT__", dirname(dirname(__FILE__)));
require_once(__ROOT__ . "/src/model/SpecialPower.php");
require_once(__ROOT__ . "/src/model/Npc.php");
require_once(__ROOT__ . "/src/controller/Game.php");
require_once(__ROOT__ . "/src/view/Console.php");
require_once (__ROOT__ . "/src/validators.php");

$first_power = new SpecialPower("Dragon's force", "power", 100, 10);
$second_power = new SpecialPower("Enchanted shield", "defense", 100, 20);

$first_player = new Npc("Carl", mt_rand(65, 95), mt_rand(60, 70), mt_rand(40, 50), mt_rand(40, 50), mt_rand(10, 30), [$first_power, $second_power]);
$second_player = new Npc("Beast", mt_rand(55, 80), mt_rand(50, 80), mt_rand(35, 55), mt_rand(40, 60), mt_rand(25, 40), []);

validate_npc($first_player);
validate_npc($second_player);
$game = new Game($first_player, $second_player);

$console = new Console($game);

$console->run();
