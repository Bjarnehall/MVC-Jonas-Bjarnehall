<?php

namespace App\Card;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Game21Draw
{
    public static function drawCard(SessionInterface $session, string $deckSerialized, string $playerSerialized): void
    {
        $deck = unserialize($deckSerialized);
        $player = unserialize($playerSerialized);

        $card = $deck->dealCard();
        if ($card) {
            $player->drawCard($card);
            $session->set('shuffledDeck', serialize($deck));
            $session->set('player', serialize($player));
        }
    }
}
