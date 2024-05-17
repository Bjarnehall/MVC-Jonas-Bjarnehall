<?php

namespace App\Card;

use App\Card\DeckTask;
use App\Card\DeckOfCards;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeckTaskTest extends TestCase
{
    public function testShuffleDeck(): void
    {
        $deck = new DeckOfCards();
        $originalOrder = $deck->getShuffledCards();

        $deck->shuffle();

        $shuffledOrder = $deck->getShuffledCards();
        $this->assertNotEquals($originalOrder, $shuffledOrder);
    }
}
