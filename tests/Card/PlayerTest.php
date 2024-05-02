<?php

namespace App\Card;

use App\Card\Card;
use App\Card\DeckOfCards;
use App\Card\CardHand;

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    /**
     * Test of constructor init cardhand
     */
    public function testConstructorInitCardHand(): void
    {
        $player = new Player();

        $reflection = new \ReflectionClass(Player::class);
        $handProperty = $reflection->getProperty('hand');
        $handProperty->setAccessible(true);
        $hand = $handProperty->getValue($player);

        $this->assertInstanceOf(CardHand::class, $hand);

        $this->assertEquals(0, count($hand->getCards()));
    }
    /**
     * Test draw card
     */
    public function testDrawCard(): void
    {
        $player = new Player();

        $card = new Card('Hearts', 'Ace');

        $this->assertEquals(0, count($player->getHand()->getCards()));

        $player->drawCard($card);

        $this->assertEquals(1, count($player->getHand()->getCards()));

        $this->assertSame($card, $player->getHand()->getCards()[0]);
    }
    /**
     * Test of getHand
     */
    public function testGetHand(): void
    {
        $player = new Player();

        $hand = $player->getHand();

        $this->assertInstanceOf(CardHand::class, $hand);

        $reflection = new \ReflectionClass(Player::class);
        $handProperty = $reflection->getProperty('hand');
        $handProperty->setAccessible(true);
        $internalHand = $handProperty->getValue($player);

        $this->assertSame($internalHand, $hand);
    }
    /**
     * Create card for testing.
     */
    public function createCard(int $value): Card
    {
        $card = $this->createMock(Card::class);
        $card->method('getValue')->willReturn($value);
        return $card;
    }
    /**
     * Test calculate score and how Aces are counted.
     */
    public function testCalculateScoreAces(): void
    {
        $player = new Player();
        $handMock = $this->createMock(CardHand::class);

        $cards = [
            $this->createCard(14),
            $this->createCard(10),
            $this->createCard(5)
        ];

        $handMock->method('getCards')->willReturn($cards);
        $reflection = new \ReflectionClass(Player::class);
        $handProperty = $reflection->getProperty('hand');
        $handProperty->setAccessible(true);
        $handProperty->setValue($player, $handMock);

        $this->assertEquals(16, $player->calculateScore());
    }
}