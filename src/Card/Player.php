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
        if($card) {
            $this->hand->addCard($card);
        }
    }

    public function getHand(): CardHand
    {
        return $this->hand;
    }

    public function calculateScore(): int
    {
        $score = 0;
        $aces =  0;
        foreach ($this->hand->getCards() as $card) {
            if ($card->getValue() === 14) {
                $aces += 1;
                $score += 14;
            }else {
                $score += $card->getValue();
            }
        }

        while ($score > 21 && $aces > 0) {
            $score -= 13;
            $aces-= 1;
        }

        return $score;
    }
}