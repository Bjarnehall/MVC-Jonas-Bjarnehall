<?php

namespace App\Dice;

use App\Dice\DiceGameTask;
use PHPUnit\Framework\TestCase;

class DiceGameTaskTest extends TestCase
{
    public function testRollDiceHand(): void
    {
        $diceGameTask = new DiceGameTask();

        $result = $diceGameTask->rollDiceHand(5);

        $this->assertIsArray($result);

        $this->assertArrayHasKey('num_dices', $result);
        $this->assertArrayHasKey('diceRoll', $result);

        $this->assertIsInt($result['num_dices']);

        $this->assertIsArray($result['diceRoll']);
    }
}
