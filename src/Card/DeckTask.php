<?php

namespace App\Card;

use App\Card\DeckOfCards;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeckTask
{
    public function ensureShuffledDeckExists(SessionInterface $session): void
    {
        if (!$session->has('shuffledDeck')) {
            $deck = new DeckOfCards();
            $deck->shuffle();
            $session->set('shuffledDeck', serialize($deck->getShuffledCards()));
        }
    }
}