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
    /**
     * Display the game 21 start page.
     *
     * @return Response
     */
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
        $session->set('shuffledDeck', serialize($deck));
        $session->set('player', serialize($player));

        return $this->redirectToRoute('game21_play');
    }
    //Game play page
    /**
     * Initiate the game by shuffle deck and save to session and,
     * inititing player.
     * 
     * @param SessionInterface $session
     * @return Response
     */
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
    /**
     * Draw a card from the deck.
     *
     * @param SessionInterface $session
     * @return Response
     */
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

            // if ($player->calculateScore() > 21) {
            //     return $this->redirectToRoute('game21_game_over');
            // }
        }
            return $this->redirectToRoute('game21_play');
        }
    /**
     * Lets the player know game is lost and chance to start over.
     *
     * @return Response
     */
    #[Route("/game21/game_over", name: "game21_game_over")]
    public function gameOver(): Response
    {
        return $this->render('card/game21_game_over.html.twig');
    }
    /**
     * Lets the player stop and let the bank play against the player.
     * 
     * @return Response
     */
    #[Route("/game21/stop", name: "game21_stop", methods: ["POST"])]
    public function stop(SessionInterface $session): Response
    {
        $session->set('turn', 'bank');

        return $this->redirectToRoute('game21_bank_play');
    }
    /**
     * Lets the bank play
     * 
     * @return Response
     */
    #[Route("/game21/bank_play", name: "game21_bank_play")]
    public function bankPlay(SessionInterface $session): Response
    {
        $deck = unserialize($session->get('shuffledDeck'));
        $bank = new Player();

        while ($bank->calculateScore()  < 17) {
            $card = $deck->dealCard();
            if ($card) {
                $bank->drawCard($card);
            } else {
                break;
            }
        }

        $session->set('bank', serialize($bank));

        return $this->render('card/game21_result.html.twig', [
            'player' => unserialize($session->get('player')),
            'bank' => $bank,
            'deck' => $deck
        ]);
    }
}
