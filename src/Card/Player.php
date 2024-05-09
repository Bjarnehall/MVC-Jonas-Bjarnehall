<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use App\Card\Game;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Player
 */
class Player
{
    /**
     * @var CardHand The player's hand of cards.
     */
    private CardHand $hand;
    /**
     * Initializes a new empty hand of cards for the player.
     */
    public function __construct()
    {
        $this->hand = new CardHand();
    }
    /**
     * Draws a card and adds it to the player's hand.
     *
     * @param Card $card card added to the hand.
     */
    public function drawCard(Card $card): void
    {
        $this->hand->addCard($card);
    }
    /**
     * Get the hand of cards.
     *
     * @return CardHand The current hand of cards.
     */
    public function getHand(): CardHand
    {
        return $this->hand;
    }
    /**
     * Calculates the total score of the hand.
     *
     * @return int The total score of hand.
     */
    public function calculateScore(): int
    {
        $score = 0;
        $aces = 0;

        foreach ($this->hand->getCards() as $card) {
            if ($card->getValue() == 14) {
                $aces++;
            } else {
                $score += $card->getValue();
            }
        }

        for ($i = 0; $i < $aces; $i++) {
            if ($score + 14 <= 21) {
                $score += 14;
            } else {
                $score += 1;
            }
        }

        return $score;
    }
    /**
     * Draws a card from the deck and adds it to the hand.
     *
     * @param DeckOfCards $deck The deck from which a card will be drawn.
     */
    public function drawCardFromDeck(DeckOfCards $deck): void
    {
        $card = $deck->dealCard();
        if ($card) {
            $this->drawCard($card);
        }
    }
}
