<?php


class Console
{
    /**
     * @var Game
     */
    private Game $game;

    /**
     * Console constructor.
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    /**
     *
     */
    public function run(): void
    {
        do {
            $this->printGameStatus();
            echo $this->game->playRound() . PHP_EOL;
            sleep(2);
        } while (!$this->game->isOver());

        echo "GAME OVER" . PHP_EOL;
        $winner = $this->game->getWinner();
        if ($winner == null) {
            echo "Game ended in tie." . PHP_EOL;
            return;
        }
        echo $winner->getName() . " has won!" . PHP_EOL;
    }

    /**
     *
     */
    private function printGameStatus()
    {
        if ($this->game->isOver()) {
            return;
        }
        $this->printRounds();
        self::printNpc($this->game->getAttacker(), "attacker");
        echo PHP_EOL;
        self::printNpc($this->game->getDefender(), "defender");
        echo PHP_EOL;
    }

    /**
     * @param Npc $npc
     * @param string $role
     */
    private static function printNpc(Npc $npc, string $role): void
    {
        if (!in_array($role, ["attacker", "defender"])) {
            return;
        }

        echo $role . ": " . $npc->toString() . PHP_EOL;
    }

    /**
     *
     */
    private function printRounds(): void
    {
        echo "ROUND: " . $this->game->getRounds() . PHP_EOL;
    }
}