<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class Player
{
    private CardHand $hand;

    public function __construct()
    {
        $this->hand = new CardHand();
    }

    public function drawCard(Card $card): void
    {
        // $card = $deck->dealCard();
        // if($card) {
            $this->hand->addCard($card);
        // }
    }

    public function getHand(): CardHand
    {
        return $this->hand;
    }
/**
 * 
 * @return int
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

}
