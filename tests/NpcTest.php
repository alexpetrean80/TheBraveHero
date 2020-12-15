<?php declare(strict_types=1);


use PHPUnit\Framework\TestCase;

class NpcTest extends TestCase
{
    public function testConstructValidTyping(): void
    {
        $npc = new Npc("AAA", 50, 51, 52, 53, 54, []);
        self::assertInstanceOf(Npc::class, $npc);
        self::assertEquals("AAA", $npc->getName());
        self::assertEquals(50, $npc->getHealth());
        self::assertEquals(51, $npc->getPower());
        self::assertEquals(52, $npc->getDefense());
        self::assertEquals(53, $npc->getSpeed());
        self::assertEquals(54, $npc->getLuck());
        self::assertEmpty($npc->getSpecialPowers());
    }

    public function testConstructInvalidTypes(): void
    {
        $this->expectException(TypeError::class);
        $npc = new Npc(3, "a", true, "32", null, 2, false);
    }

    public function testUseSpecialPower(): void
    {
        $special_power = new SpecialPower("test_power", "power", 20, 10);
        $npc = new Npc("test_npc", 50, 100, 20, 12, 1, [$special_power]);
        self::assertEquals(100, $npc->getPower());
        $npc->useSpecialPower();
        self::assertEquals(120, $npc->getPower());
    }
}
