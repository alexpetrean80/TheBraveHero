<?php declare(strict_types=1);

class Game
{

    private Npc $attacker;
    private Npc $defender;
    private int $rounds;

    /**
     * Game constructor.
     * @param Npc $first_player
     * @param Npc $second_player
     */
    public function __construct(Npc $first_player, Npc $second_player)
    {
        $this->rounds = 1;
        if ($first_player->getSpeed() > $second_player->getSpeed()) {
            $this->attacker = $first_player;
            $this->defender = $second_player;
        } elseif ($first_player->getSpeed() === $second_player->getSpeed()) {
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


    public function getRounds(): int
    {
        return $this->rounds;
    }

    /**
     * @return Npc|null
     */
    public function getWinner(): ?Npc
    {
        if ($this->attacker->getHealth() === 0) {
            return $this->defender;
        }
        if ($this->defender->getHealth() === 0) {
            return $this->attacker;
        }
        return null;
    }

    private function attack(): void
    {
        $damage = $this->computeDamage();
        $hp = $this->defender->getHealth() - $damage;
        if ($hp < 0) {
            $hp = 0;
        }
        $this->defender->setHealth($hp);
    }

    public function playRound(): string
    {
        $message = $this->attacker->maybeUseSpecialPower();
        $message = $message . PHP_EOL . $this->defender->maybeUseSpecialPower();

        if ($this->willAttackMiss()) {
            $message = $message . PHP_EOL . "Attacker missed.";
        } else {
            $this->attack();
        }

        $this->attacker->restoreInitialStats();
        $this->defender->restoreInitialStats();

        $this->switchRoles();
        $this->rounds++;
        return $message;
    }

    public function isOver(): bool
    {
        if ($this->rounds > 20) {
            return true;
        }

        if ($this->attacker->isDead()) {
            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    private function computeDamage(): int
    {
        $damage = $this->attacker->getPower() - $this->defender->getDefense();
        if ($damage > 100) {
            return 100;
        }
        if ($damage < 0) {
            return 0;
        }
        return $damage;
    }

    private function switchRoles(): void
    {
        $aux = $this->attacker;
        $this->attacker = $this->defender;
        $this->defender = $aux;
    }


    private function willAttackMiss(): bool
    {
        $luck = $this->defender->getLuck();
        $randomness = mt_rand(0, 100);
        if ($randomness >= $luck) {
            return false;
        }

        return true;
    }
}

