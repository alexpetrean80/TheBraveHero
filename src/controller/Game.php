<?php declare(strict_types=1);

class Game
{
    private Npc $attacker;
    private Npc $defender;

    /**
     * Game constructor.
     * @param $first_player
     * @param $second_player
     */
    public function __construct(Npc $first_player, Npc $second_player)
    {
        if ($first_player->getSpeed() > $second_player->getSpeed()) {
            $this->attacker = $first_player;
            $this->defender = $second_player;
        } else if ($first_player->getSpeed() == $second_player->getSpeed()) {
            if ($first_player->getLuck() >= $second_player->getLuck()) {
                $this->attacker = $first_player;
                $this->defender = $second_player;
            } else {
                $this->attacker = $second_player;
                $this->defender = $first_player;
            }
        } else {
            $this->attacker = $second_player;
            $this->defender = $first_player;
        }
    }

    /**
     * @return mixed
     */
    public function getAttacker(): Npc
    {
        return $this->attacker;
    }

    /**
     * @return mixed
     */
    public function getDefender(): Npc
    {
        return $this->defender;
    }

    private function computeDamage(): int {
        $damage =  $this->attacker->getPower() - $this->defender->getDefense();
        if ($damage > 100) {
            return 100;
        }
        if ($damage < 0) {
            return 0;
        }
        return $damage;
    }

    private function getWinner(): Npc {
        return   $this->defender->getHealth() == 0 ? $this->attacker : $this->defender;

    }

}

