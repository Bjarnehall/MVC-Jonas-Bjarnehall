<?php

namespace App\Card;

/**
 * Represents a single playing card with a suit and value.
 */
class Card
{
    /**
     * Suit of the card.
     * 
     * @var string
     */
    private string $suit;
    /**
     * Value of the card.
     * 
     * @var string|int
     */
    private string|int $value;

    public function __construct(string $suit, string|int $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getValue(): string|int
    {
        return $this->value;
    }
    /**
     * Generates a HTML representation of the card.
     *
     * @return string
     */
    public function getGraphicalRepresentation(): string
    {
        $suitSymbol = match($this->suit) {
            'Hearts' => '♥',
            'Diamonds' => '♦',
            'Clubs' => '♣',
            'Spades' => '♠',
            default => '?',
        };

        $valueRepresentation = match($this->value) {
            '11' => 'J',
            '12' => 'Q',
            '13' => 'K',
            '14' => 'A',
            default => $this->value,
        };

        return sprintf(
            '<span class="card-value">%s</span><span class="card-suit %s">%s</span>',
            htmlspecialchars($valueRepresentation),
            htmlspecialchars(strtolower($this->suit)),
            htmlspecialchars($suitSymbol)
        );
    }
}
