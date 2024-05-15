<?php

namespace App\Dice;

use App\Dice\DiceGraphic;
use App\Dice\Dice;

use PHPUnit\Framework\TestCase;

class DiceGraphicTest extends TestCase
{
    public function testGetAsString(): void
    {
        $dice = new DiceGraphic();

        $reflection = new \ReflectionClass($dice);
        $property = $reflection->getProperty('value');
        $property->setAccessible(true);
        $property->setValue($dice, 1);

        $this->assertSame('⚀', $dice->getAsString());
    }
}
