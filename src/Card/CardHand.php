<?php

namespace App\Card;

/**
 * Represents a hand of cards.
 */
class CardHand
{
    /**
     * Array of Card
     *
     * @var Card[]
     */
    private array $cards = [];

    public function addCard(Card $card): void
    {
        $this->cards[] = $card;
    }
    /**
     * Returns the cards
     *
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

}
