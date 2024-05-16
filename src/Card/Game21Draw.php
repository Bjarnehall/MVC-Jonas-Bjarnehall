<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use App\Card\Player;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Game21Draw
{
    public static function drawCard(SessionInterface $session, string $deckSerialized, string $playerSerialized): void
    {
        $deck = self::getDeckFromSession($session, $deckSerialized);
        $player = unserialize($playerSerialized);

        $card = $deck->dealCard();
        if ($card) {
            $player->drawCard($card);
            $session->set('shuffledDeck', serialize($deck));
            $session->set('player', serialize($player));
        }
    }

    private static function getDeckFromSession(SessionInterface $session, string $deckSerialized): DeckOfCards
    {
        $deck = unserialize($deckSerialized);
        if (!($deck instanceof DeckOfCards)) {
            throw new \InvalidArgumentException('Invalid deck data.');
        }
        return $deck;
    }
}
