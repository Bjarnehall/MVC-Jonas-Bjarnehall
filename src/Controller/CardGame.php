<?php

namespace App\Controller;

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

class CardGame extends AbstractController
{
    /**
     * Display the card game start page.
     *
     * @param SessionInterface $session
     * @return Response
     */
    #[Route("/card", name: "card")]
    public function index(SessionInterface $session): Response
    {
        if(!$session->has('shuffledDeck')) {
            $deck = new DeckOfCards();
            $deck->shuffle();
            $session->set('shuffledDeck', serialize($deck->getShuffledCards()));
        }
        return $this->render('card/card.html.twig');
    }
    /**
     * Display a sorted deck of cards.
     *
     * @return Response
     */
    #[Route("/card/deck", name: "deck")]
    public function cards()
    {
        $deck = new DeckOfCards();
        $cards = $deck->getSortedCards();

        return $this->render('card/deck.html.twig', [
            'cards' => $cards,
        ]);
    }
    /**
     * Displays a sorted list of cards as a JSON response.
     *
     * @return JsonResponse
     */
    #[Route("/api/deck", name: "api_deck")]
    public function apiDeck(): Response
    {
        $deck = new DeckOfCards();
        $cards = $deck->getSortedCards();

        $data = array_map(function ($card) {
            return [
                'suit' => $card->getSuit(),
                'value' => $card->getValue()
            ];
        }, $cards);

        return new JsonResponse($data);
    }
    /**
     * Shuffle the deck and update the session.
     *
     * @param SessionInterface $session
     * @return Response
     */
    #[Route("/card/deck/shuffle", name: "shuffle")]
    public function shuffle(SessionInterface $session): Response
    {
        $deck = new DeckOfCards();
        $deck->shuffle();
        $shuffledCards = $deck->getShuffledCards();
        $session->set('shuffledDeck', serialize($shuffledCards));

        return $this->render('card/shuffle.html.twig', [
            'cards' => $shuffledCards,
        ]);
    }
    /**
     * Displays a shuffled list of cards as a JSON response
     *
     * @return JsonResponse
     */
    #[route("/api/deck/shuffle", name: "api_deck_shuffle", methods: ["POST"])]
    public function apiDeckShuffle(SessionInterface $session): JsonResponse
    {
        $deck = new DeckOfCards();
        $deck->shuffle();
        // $cards = $deck->getShuffledCards();
        $shuffledCards = $deck->getShuffledCards();
        $session->set('shuffledDeck', serialize($shuffledCards));

        $data = array_map(function ($card) {
            return [
                'suit' => $card->getSuit(),
                'value' => $card->getValue()
            ];
        }, $shuffledCards);

        return new JsonResponse($data);
    }
    /**
     * Clear all session variables and redirect to session display.
     *
     * @param SessionInterface $session
     * @return RedirectResponse
     */
    #[Route("/session/delete", name: "session_destroy")]
    public function destroySession(SessionInterface $session): RedirectResponse
    {
        $session->clear();

        $this->addFlash(
            'notice',
            'The session was destroyed!'
        );

        return $this->redirectToRoute('session');
    }
    /**
     * Draw a single card from the deck.
     *
     * @param SessionInterface $session
     * @return Response
     */
    #[Route("/card/deck/draw", name: "draw_card")]
    public function drawCard(SessionInterface $session): Response
    {
        if (!$session->has('shuffledDeck')) {
            $deck = new DeckOfCards();
            $deck->shuffle();
            $session->set('shuffledDeck', serialize($deck->getShuffledCards()));
        }

        $deck = unserialize($session->get('shuffledDeck'));
        if (empty($deck)) {
            return $this->redirectToRoute('shuffle');
        }

        $card = array_shift($deck);
        $session->set('shuffledDeck', serialize($deck));

        return $this->render('card/draw.html.twig', [
            'card' => $card,
            'remaining' => count($deck)
        ]);
    }
    /**
     * Displays a single card as a JSON response.
     *
     * @return JsonResponse
     */
    #[Route("/api/deck/draw", name: "api_deck_draw", methods: ["POST"])]
    public function apiDrawCard(SessionInterface $session): Response
    {
        if (!$session->has('shuffledDeck')) {
            $deck = new DeckOfCards();
            $deck->shuffle();
            $session->set('shuffledDeck', serialize($deck->getShuffledCards()));
        }

        $deck = unserialize($session->get('shuffledDeck'));
        if (empty($deck)) {
            return new JsonResponse(['error' => 'No cards left to draw'], 400);
            // return $this->redirectToRoute('api_deck_shuffle');
        }

        $card = array_shift($deck);
        $session->set('shuffledDeck', serialize($deck));

        $cardData = [
            'suit' => $card->getSuit(),
            'value' => $card->getValue(),
            'remaining' => count($deck)
        ];

        return new JsonResponse($cardData);
    }
    /**
     * Draws multiple cards from the deck.
     *
     * @param SessionInterface $session
     * @param int $number
     * @return Response
     */
    #[Route("/card/deck/draw/{number}", name: "draw_cards", )]
    public function drawMultipleCards(SessionInterface $session, int $number): Response
    {
        if (!$session->has('shuffledDeck')) {
            $deck = new DeckOfCards();
            $deck->shuffle();
            $session->set('shuffledDeck', serialize($deck->getShuffledCards()));
        }

        $deck = unserialize($session->get('shuffledDeck'));
        if (count($deck) < $number) {
            return $this->redirectToRoute('shuffle');
        }

        $cardsDrawn = array_splice($deck, 0, $number);
        $session->set('shuffledDeck', serialize($deck));

        return $this->render('card/draw_cards.html.twig', [
            'card' => $cardsDrawn,
            'remaining' => count($deck)
        ]);
    }
    /**
     * Displays multiple cards as a JSON response.
     *
     * @return JsonResponse
     */
    #[Route("api/deck/draw/{number}", name: "api_card_draw_cards", methods: ["POST"])]
    public function apiDrawCards(SessionInterface $session, int $number): JsonResponse
    {
        if (!$session->has('shuffledDeck')) {
            $deck = new DeckOfCards();
            $deck->shuffle();
            $session->set('shuffledDeck', serialize($deck->getShuffledCards()));
        }

        $deck = unserialize($session->get('shuffledDeck'));
        if (count($deck) < $number) {
            // return $this->redirectToRoute('api_deck_shuffle');
            return new JsonResponse(['error' => 'Not enough cards to draw'], 400);
        }

        $cardsDrawn = array_splice($deck, 0, $number);
        $session->set('shuffledDeck', serialize($deck));

        $cardsData = array_map(function ($card) {
            return [
                'suit' => $card->getSuit(),
                'value' => $card->getValue()
            ];
        }, $cardsDrawn);

        return new JsonResponse([
            'cards' => $cardsData,
            'remaining' => count($deck)
        ]);
    }
}
