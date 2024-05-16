<?php

namespace App\Dice;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Exception;



class DiceGameTask
{
    public function __construct()
    {

    }
    public function rollAndUpdateRound(SessionInterface $session): void
    {
        $hand = $session->get("pig_dicehand");
        $hand->roll();

        $roundTotal = $session->get("pig_round");
        $round = 0;
        $values = $hand->getValues();
        foreach ($values as $value) {
            if ($value === 1) {
                $round = 0;
                $roundTotal = 0;/** @var \Symfony\Component\HttpFoundation\Session\Session $session */
                $session->getFlashBag()->add('warning', 'You got a 1 and you lost the round points!');
                break;
            }
            $round += $value;
        }
        $session->set("pig_round", $roundTotal + $round);
    }
/**
 * @return array{num_dices: int, diceRoll: array<string>}
 */
    public function rollDiceHand(int $num): array
    {
        if ($num > 99) {
            throw new Exception("Cannot roll morre than 99 dices!");
        }

        $hand = new DiceHand();
        for ($i = 1; $i <= $num; $i++) {
            $diceToAdd = $i % 2 === 1 ? new DiceGraphic() : new Dice();
            $hand->add($diceToAdd);
        }

        $hand->roll();

        return [
            "num_dices" => $hand->getNumberDices(),
            "diceRoll" => $hand->getString(),
        ];
    }
}
