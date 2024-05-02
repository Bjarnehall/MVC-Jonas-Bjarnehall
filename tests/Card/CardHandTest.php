<?php

namespace App\Card;

use App\Card\CardHand;

use PHPUnit\Framework\TestCase;

class CardHandTest extends TestCase
{
    /**
     * Test the function GetCards
     */
    public function testGetCards(): void
    {
        $hand = new CardHand();
        $card1 = new Card('Hearts', '10');
        $card2 = new Card('Spades', 'A');

        $hand->addCard($card1);
        $hand->addCard($card2);

        $cards = $hand->getCards();

        $this->assertCount(2, $cards);
        $this->assertSame($card1, $cards[0]);
        $this->assertSame($card2, $cards[1]);
    }
    /**
     * Test the function AddCard
     */
    public function testAddCard(): void
    {
        $hand = new CardHand();
        $card = new Card('Hearts', '10');
        $hand->addCard($card);

        $cards = $hand->getCards();
        $this->assertCount(1, $cards);
        $this->assertSame($card, $cards[0]);
    }
}
