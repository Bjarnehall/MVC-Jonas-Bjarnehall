<?php

namespace App\Controller;

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


class Game21 extends AbstractController
{
    #[Route("/game", name: "game21")]
    public function home(): Response
    {
        return $this->render('card/game21.html.twig');
    }

    #[Route("/play21", name: "play21")]
    public function play21(SessionInterface $session): Response
    {
        $deck = new DeckOfCards();
        $deck->shuffle();
        $session->set('shuffledDeck', serialize($deck->getShuffledCards()));
        return $this->redirectToRoute('game21_play');
    }

    #[Route("/game21/play", name: "game21_play")]
    public function gamePlay(SessionInterface $session): Response
    {
        $deck = unserialize($session->get('shuffledDeck'));
        return $this->render('card/game21_play.html.twig', [
            'cards' => $deck,
            'sessionData' => $session->all()
        ]);
    }
}