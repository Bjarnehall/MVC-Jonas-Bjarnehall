<?php

namespace App\Card;

/**
 * Represents a deck of playing cards.
 */
class DeckOfCards
{
    private $cards = [];
    /**
     * Initializes the deck
     */
    public function __construct()
    {
        $this->initialize();
    }
    private function initialize()
    {
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14'];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $this->cards[] = new Card($suit, $value);
            }
        }
    }
    /**
     * Shuffles cards in deck
     */
    public function shuffle()
    {
        shuffle($this->cards);
    }
    /**
     * Gets and returns an array of cards
     *
     * @return array The shuffled cards
     */
    public function getShuffledCards()
    {
        $this->shuffle();
        return $this->cards;
    }
    /**
     * Deals a card from the deck and removes it
     *
     * @return Card|null
     */
    public function dealCard()
    {
        return array_shift($this->cards);
    }
    /**
     * Gets and returns an array of cards
     *
     * @return array The sorted cards
     */
    public function getSortedCards()
    {
        $sortedCards = $this->cards;
        usort($sortedCards, function ($cardOne, $cardTwo) {
            if ($cardOne->getSuit() == $cardTwo->getSuit()) {
                return $cardOne->getValue() <=> $cardTwo->getValue();
            }
            return $cardOne->getSuit() <=> $cardTwo->getSuit();
        });
        return $sortedCards;
    }
}
