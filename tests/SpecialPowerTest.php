<?php


use PHPUnit\Framework\TestCase;

class SpecialPowerTest extends TestCase
{
    public function testConstruct(): void
    {
        $special_power = new SpecialPower("test_power", "power", 50, 10);
        self::assertInstanceOf(SpecialPower::class, $special_power);
        self::assertEquals("test_power", $special_power->getName());
        self::assertEquals("power", $special_power->getStatAffected());
        self::assertEquals(50, $special_power->getPercentAffected());
        self::assertEquals(10, $special_power->getChance());
    }

}
