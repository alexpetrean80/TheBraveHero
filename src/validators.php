<?php declare(strict_types=1);

/**
 * @param Npc $npc
 * @throws ValidationError
 */
function validate_npc(Npc $npc): void
{
    if ($npc->getLuck() > 100 || $npc->getLuck() < 0) {
        throw new ValidationError("Luck must have a value between 1% and 100%.");
    }
}

/**
 * @param SpecialPower $power
 * @throws ValidationError
 */
function validate_special_power(SpecialPower $power): void
{
    if ($power->getPercentAffected() > 100 || $power->getPercentAffected() < -100) {
        throw new ValidationError($power->getName() . " must affect between 1% and 100% of the given stat");
    }
    if ($power->getChance() > 100 || $power->getChance() < 0) {
        throw new ValidationError($power->getName() . " must have a chance of between 1% and 100%");
    }
    if (array_search($power->getStatAffected(), array("power", "defense", "speed", "luck")) == false) {
        throw new ValidationError("Stat affected does not exist.");
    }
}
