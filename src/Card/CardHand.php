<?php

namespace App\Card;

/**
 * Represents a hand of cards.
 */
class CardHand
{
    private $cards = [];

    public function addCard(Card $card)
    {
        $this->cards[] = $card;
    }

    public function getCards()
    {
        return $this->cards;
    }
}
