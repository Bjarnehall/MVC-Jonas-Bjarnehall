<?php

namespace App\Dice;

use App\Dice\DiceHand;
use App\Dice\Dice;
use App\Dice\DiceGraphic;

use PHPUnit\Framework\TestCase;
/**
 * Class DiceHandTest
 *
 * Tests the DiceHand class.
 */
class DiceHandTest extends TestCase
{
    /**
     * Tests the add method of the DiceHand class.
     *
     * @return void
     */
    public function testAdd(): void
    {
        $diceHand = new DiceHand();
        $dice = new Dice();

        $diceHand->add($dice);

        $reflection = new \ReflectionClass(DiceHand::class);
        $property = $reflection->getProperty('hand');
        $property->setAccessible(true);

        $handArray = $property->getValue($diceHand);
        $this->assertContains($dice, $handArray);
        $this->assertCount(1, $handArray);
    }

    /**
     * Tests the roll method of the DiceHand class.
     *
     * @return void
     */
    public function testRoll(): void
    {
        $diceHand = new DiceHand();

        $dice1 = $this->createMock(Dice::class);
        $dice2 = $this->createMock(Dice::class);

        $dice1->expects($this->once())->method('roll');
        $dice2->expects($this->once())->method('roll');

        $diceHand->add($dice1);
        $diceHand->add($dice2);

        $diceHand->roll();
    }

}