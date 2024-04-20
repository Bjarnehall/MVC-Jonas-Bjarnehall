<?php

namespace App\Controller;

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


class Game21 extends AbstractController
{
    //Game start page
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
        $player = new Player();

        // Serialize the entire deck object, not just the shuffled cards
        $session->set('shuffledDeck', serialize($deck));
        $session->set('player', serialize($player));

        return $this->redirectToRoute('game21_play');
    }
    //Game play page
    #[Route("/game21/play", name: "game21_play")]
    public function gamePlay(SessionInterface $session): Response
    {
        $deck = unserialize($session->get('shuffledDeck'));
        $player = unserialize($session->get('player'));
        $score = $player->calculateScore();
        return $this->render('card/game21_play.html.twig', [
            // 'cards' => $deck,
            // 'sessionData' => $session->all()
            'cards' => $player->getHand()->getCards(),
            'score' => $score,
            'sessionData' => $session->all()
        ]);
    }
    // Drawing cards

    #[Route("/game21/draw", name: "game21_draw", methods: ["POST"])]
    public function game21_draw(SessionInterface $session): Response
    {
        $deckSerialized = $session->get('shuffledDeck');
        $playerSerialized = $session->get('player');

        if (!$deckSerialized || !$playerSerialized) {
            return $this->redirectToRoute('play21');
        }

        $deck = unserialize($deckSerialized);
        $player = unserialize($playerSerialized);

        $card = $deck->dealCard();
        if ($card) {
            $player->drawCard($card);
            $session->set('shuffledDeck', serialize($deck));
            $session->set('player', serialize($player));

            if ($player->calculateScore() > 21){
                return $this->redirectToRoute('game21_game_over');
            }
        }

        // Redirect back to the game page where the hand is displayed
        return $this->redirectToRoute('game21_play');
    }
    // game over
    #[Route("/game21/game_over", name: "game21_game_over")]
    public function gameOver(): Response
    {
        return $this->render('card/game21_game_over.html.twig');
    }
}



