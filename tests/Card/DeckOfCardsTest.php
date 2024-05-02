<?php

namespace App\Card;

use App\Card\DeckOfCards;
use App\Card\Card;
use App\Card\CardHand;
use PHPUnit\Framework\TestCase;

class DeckOfCardsTest extends TestCase
{
    private DeckOfCards $deck;

    protected function setUp(): void
    {
        $this->deck = new DeckOfCards();
    }
    /**
     * Test the constructor for initialising a deck of cards.
     */
    public function testDeckInit(): void
    {
        $deck = new DeckOfCards();

        $reflection = new \ReflectionClass($deck);
        $cardsProperty = $reflection->getProperty('cards');
        $cardsProperty->setAccessible(true);
        $cards = $cardsProperty->getValue($deck);

        $this->assertCount(52, $cards);

        $firstCard = $cards[0];
        $lastCard = $cards[51];

        $this->assertEquals('Hearts', $firstCard->getSuit());
        $this->assertEquals('2', $firstCard->getValue());
        $this->assertEquals('Spades', $lastCard->getSuit());
        $this->assertEquals('14', $lastCard->getValue());
    }
    /**
     * Test of shuffling the cards
     */
    public function testShuffle(): void
    {
        $deck = new DeckOfCards();
        $sortedCards = $deck->getSortedCards();
        $shuffledCards = $deck->getShuffledCards();

        $this->assertCount(count($sortedCards), $shuffledCards);
        $this->assertEmpty(array_diff(array_map('serialize', $sortedCards), array_map('serialize', $shuffledCards)));
        $this->assertNotEquals(serialize($sortedCards), serialize($shuffledCards));

        $anotherShuffle = $deck->getShuffledCards();
        $this->assertNotEquals(serialize($shuffledCards), serialize($anotherShuffle));
    }
    /**
     * Test of dealCard deck
     */
    public function testDealCardFromDeck(): void
    {
        $initialCount = count($this->deck->getSortedCards());
        $card = $this->deck->dealCard();

        $initialCount = count($this->deck->getSortedCards());
        $card = $this->deck->dealCard();

        $this->assertInstanceOf(Card::class, $card);
        $this->assertCount($initialCount - 1, $this->deck->getSortedCards());
    }
}
