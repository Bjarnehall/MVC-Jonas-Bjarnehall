<?php

namespace App\Dice;

use App\Dice\Dice;

class DiceHand
{
    /**
     * @var Dice[]
     * 
     * Hand store an array of Dice objects.
     */
    private array $hand = [];

    public function add(Dice $die): void
    {
        $this->hand[] = $die;
    }

    public function roll(): void
    {
        foreach ($this->hand as $die) {
            $die->roll();
        }
    }

    public function getNumberDices(): int
    {
        return count($this->hand);
    }
    /**
     * Get the values of the dice in the hand.
     *
     * @return int[] Array of dice values.
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getValue();
        }
        return $values;
    }
    /**
     * Get the string representations of the dice in the hand.
     *
     * @return string[] Array of string representations of dice.
     */
    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getAsString();
        }
        return $values;
    }
}
