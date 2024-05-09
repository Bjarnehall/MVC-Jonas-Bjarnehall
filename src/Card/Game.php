<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use App\Card\Player;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class Game
{
    /**
     * Session management for the game.
     *
     * @var SessionInterface
     */
    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function initializeGame(): void
    {
        $deck = new DeckOfCards();
        $deck->shuffle();
        $player = new Player();
        $bank = new Player();
        $this->session->set('shuffledDeck', serialize($deck));
        $this->session->set('player', serialize($player));
        $this->session->set('bank', serialize($bank));
    }
}
