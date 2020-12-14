<?php

function validate_npc(Npc $npc) {
    if ($npc->getLuck() > 100 || $npc->getLuck() < 0) {
        throw new ValidationException("Luck must have a value between 1% and 100%.");
    }
}

function validate_special_power(SpecialPower $power) {
    if ($power->getPercentAffected() > 100 || $power->getPercentAffected() < 0) {
        throw new ValidationException($power->getName() . " must affect between 1% and 100% of the given stat");
    }
    if ($power->getChance() > 100 || $power->getChance() < 0) {
        throw new ValidationException($power->getName() . " must have a chance of between 1% and 100%");
    }
    if (array_search($power->getStatAffected(), array("power", "defense", "speed", "luck")) == false) {
        throw new ValidationException("Stat affected does not exist.");
    }
}
