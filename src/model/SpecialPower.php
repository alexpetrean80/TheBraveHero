<?php declare(strict_types=1);

/**
 * Class SpecialPower
 */
class SpecialPower
{
    private string $name;
    private string $stat_affected;
    private int $percent_affected;
    private int $chance;

    /**
     * SpecialPower constructor.
     * @param string $name
     * @param string $stat_affected
     * @param int $percent_affected
     * @param int $chance
     */
    public function __construct(string $name, string $stat_affected, int $percent_affected, int $chance)
    {
        $this->name = $name;
        $this->stat_affected = $stat_affected;
        $this->percent_affected = $percent_affected;
        $this->chance = $chance;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStatAffected(): string
    {
        return $this->stat_affected;
    }

    /**
     * @return int
     */
    public function getPercentAffected(): int
    {
        return $this->percent_affected;
    }

    /**
     * @return int
     */
    public function getChance(): int
    {
        return $this->chance;
    }

}

