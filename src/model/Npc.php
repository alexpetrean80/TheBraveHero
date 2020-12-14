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

    public function useSpecialPower()
    {
        $powers_count = count($this->special_powers);
        if ($powers_count == 0) {
            return;
        }
        $index = rand(0, $powers_count - 1);
        $special_power = $this->special_powers[$index];
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

    /**
     * @param int $stat
     * @param int $percent
     * @return int
     */
    static private function modifyStat(int $stat, int $percent): int
    {
        return (int)(($stat * $percent) / 100);
    }
}

