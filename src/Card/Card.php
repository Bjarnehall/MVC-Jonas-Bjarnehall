<?php

namespace App\Card;

class Card
{
    private $suit;
    private $value;

    public function __construct($suit, $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getSuit()
    {
        return $this->suit;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getGraphicalRepresentation()
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
