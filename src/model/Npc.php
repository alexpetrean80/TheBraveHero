<?php declare(strict_types=1);

class Npc
{
    private string $name;
    private int $health;
    private int $power;
    private int $defense;
    private int $speed;
    private int $luck;
    private array $special_powers;
    private array $initialStats;

    /**
     * Npc constructor.
     * @param string $name
     * @param int $health
     * @param int $power
     * @param int $defense
     * @param int $speed
     * @param int $luck
     * @param array $special_powers
     */
    public function __construct(string $name, int $health, int $power, int $defense, int $speed, int $luck, array $special_powers)
    {
        $this->name = $name;
        $this->health = $health;
        $this->power = $power;
        $this->defense = $defense;
        $this->speed = $speed;
        $this->luck = $luck;
        $this->special_powers = $special_powers;
        $this->initialStats = ["power" => $power, "defense" => $defense, "speed" => $speed, "luck" => $luck];
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @param int $health
     */
    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    /**
     * @return int
     */
    public function getPower(): int
    {
        return $this->power;
    }

    /**
     * @return int
     */
    public function getDefense(): int
    {
        return $this->defense;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    /**
     * @return array
     */
    public function getSpecialPowers(): array
    {
        return $this->special_powers;
    }

    public function maybeUseSpecialPower(): ?string
    {
        if (empty($this->special_powers)) {
            return null;
        }
        $index = rand(0, count($this->special_powers) - 1);
        $special_power = $this->special_powers[$index];

        if (!$this->doesSpecialPowerActivate($special_power)) {
            return null;
        }

        $this->useSpecialPower($special_power);
        return $this->name . " used " . $special_power->getName();
    }

    public function restoreInitialStats(): void
    {
        $this->power = $this->initialStats["power"];
        $this->defense = $this->initialStats["defense"];
        $this->speed = $this->initialStats["speed"];
        $this->luck = $this->initialStats["luck"];
    }

    public function toString(): string
    {
        return $this->name . " HP:" . $this->health . PHP_EOL . "STATS:" . PHP_EOL . "power - " . $this->power . PHP_EOL . "defense - " . $this->defense;

    }

    public function isDead(): bool
    {
        if ($this->health == 0) {
            return true;
        }
        return false;
    }

    /**
     * @param int $stat
     * @param int $percent
     * @return int
     */
    static private function modifyStat(int $stat, int $percent): int
    {
        return $stat + (int)(($stat * $percent) / 100);
    }

    private function useSpecialPower(SpecialPower $special_power): void
    {
        if (empty($this->special_powers)) {
            return;
        }
        $percent = $special_power->getPercentAffected();
        switch ($special_power->getStatAffected()) {
            case "health":
                $this->health = self::modifyStat($this->health, $percent);
                break;
            case "power":
                $this->power = self::modifyStat($this->power, $percent);
                break;
            case "defense":
                $this->defense = self::modifyStat($this->defense, $percent);
                break;
            case "speed":
                $this->speed = self::modifyStat($this->speed, $percent);
                break;
            case "luck":
                $this->luck = self::modifyStat($this->luck, $percent);
                break;
        }

    }

    private function doesSpecialPowerActivate($special_power): bool
    {
        $chance = $special_power->getChance();
        $randomness = mt_rand(0, 100);
        if ($randomness >= $chance) {
            return false;
        }
        return true;
    }

}

